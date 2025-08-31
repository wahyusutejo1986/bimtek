#!/bin/bash

# Laravel Cybersecurity Training App - Auto Deployment Script
# Ubuntu 24.04 LTS + Nginx + MariaDB + PHP
# Author: Wahyu Sutejo
# Purpose: Automated deployment for cybersecurity training environment

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration variables
DOMAIN="bimtek.local"  # Change this to your domain
DB_NAME="bimtek_db"
DB_USER="bimtek_user"
DB_PASSWORD="SecurePassword123!"  # Change this password
APP_USER="www-data"
APP_PATH="/var/www/bimtek"
REPO_URL="https://github.com/wahyusutejo1986/bimtek.git"

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Function to check if running as root
check_root() {
    if [[ $EUID -ne 0 ]]; then
        print_error "This script must be run as root (use sudo)"
        exit 1
    fi
}

# Function to update system
update_system() {
    print_status "Updating system packages..."
    apt update && apt upgrade -y
    print_success "System updated successfully"
}

# Function to install required packages
install_packages() {
    print_status "Installing required packages..."
    
    # Install basic packages
    apt install -y curl wget git unzip software-properties-common apt-transport-https ca-certificates lsb-release gnupg2
    
    # Install Nginx
    apt install -y nginx
    
    # Install MariaDB
    apt install -y mariadb-server mariadb-client
    
    # Install PHP 8.2 and extensions
    add-apt-repository ppa:ondrej/php -y
    apt update
    apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-gd php8.2-curl php8.2-mbstring php8.2-zip php8.2-bcmath php8.2-tokenizer php8.2-json php8.2-intl php8.2-soap php8.2-redis php8.2-memcached
    
    # Install Node.js and npm
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
    apt install -y nodejs
    
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
    print_success "All packages installed successfully"
}

# Function to configure MariaDB
configure_mariadb() {
    print_status "Configuring MariaDB..."
    
    # Secure MariaDB installation
    mysql_secure_installation <<EOF

y
$DB_PASSWORD
$DB_PASSWORD
y
y
y
y
EOF

    # Create database and user
    mysql -u root -p$DB_PASSWORD <<EOF
CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
EOF

    # Start and enable MariaDB
    systemctl start mariadb
    systemctl enable mariadb
    
    print_success "MariaDB configured successfully"
}

# Function to configure PHP
configure_php() {
    print_status "Configuring PHP..."
    
    # Update PHP configuration
    sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php/8.2/fpm/php.ini
    sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 64M/' /etc/php/8.2/fpm/php.ini
    sed -i 's/post_max_size = 8M/post_max_size = 64M/' /etc/php/8.2/fpm/php.ini
    sed -i 's/max_execution_time = 30/max_execution_time = 300/' /etc/php/8.2/fpm/php.ini
    sed -i 's/memory_limit = 128M/memory_limit = 512M/' /etc/php/8.2/fpm/php.ini
    
    # Start and enable PHP-FPM
    systemctl start php8.2-fpm
    systemctl enable php8.2-fpm
    
    print_success "PHP configured successfully"
}

# Function to deploy Laravel application
deploy_laravel() {
    print_status "Deploying Laravel application..."
    
    # Create application directory
    mkdir -p $APP_PATH
    cd /var/www
    
    # Clone repository
    if [ -d "$APP_PATH" ]; then
        rm -rf $APP_PATH
    fi
    
    git clone $REPO_URL bimtek
    cd $APP_PATH
    
    # Install Composer dependencies
    composer install --no-dev --optimize-autoloader
    
    # Install Node.js dependencies and build assets
    npm install
    npm run production
    
    # Copy and configure environment file
    cp .env.example .env
    
    # Generate application key
    php artisan key:generate
    
    # Configure database in .env
    sed -i "s/DB_DATABASE=laravel/DB_DATABASE=$DB_NAME/" .env
    sed -i "s/DB_USERNAME=root/DB_USERNAME=$DB_USER/" .env
    sed -i "s/DB_PASSWORD=/DB_PASSWORD=$DB_PASSWORD/" .env
    sed -i "s/APP_URL=http:\/\/localhost/APP_URL=http:\/\/$DOMAIN/" .env
    sed -i "s/APP_ENV=local/APP_ENV=production/" .env
    sed -i "s/APP_DEBUG=true/APP_DEBUG=false/" .env
    
    # Run database migrations and seeders
    php artisan migrate:fresh --seed --force
    
    # Create storage link
    php artisan storage:link
    
    # Clear and cache configuration
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    # Set proper permissions
    chown -R $APP_USER:$APP_USER $APP_PATH
    chmod -R 755 $APP_PATH
    chmod -R 775 $APP_PATH/storage
    chmod -R 775 $APP_PATH/bootstrap/cache
    
    print_success "Laravel application deployed successfully"
}

# Function to configure Nginx
configure_nginx() {
    print_status "Configuring Nginx..."
    
    # Create Nginx configuration
    cat > /etc/nginx/sites-available/$DOMAIN <<EOF
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN www.$DOMAIN;
    root $APP_PATH/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    # Security headers for cybersecurity training
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
    
    # Logs for monitoring
    access_log /var/log/nginx/${DOMAIN}_access.log;
    error_log /var/log/nginx/${DOMAIN}_error.log;
}
EOF

    # Enable site
    ln -sf /etc/nginx/sites-available/$DOMAIN /etc/nginx/sites-enabled/
    
    # Remove default site
    rm -f /etc/nginx/sites-enabled/default
    
    # Test Nginx configuration
    nginx -t
    
    # Start and enable Nginx
    systemctl start nginx
    systemctl enable nginx
    systemctl reload nginx
    
    print_success "Nginx configured successfully"
}

# Function to configure firewall
configure_firewall() {
    print_status "Configuring UFW firewall..."
    
    # Install and configure UFW
    apt install -y ufw
    
    # Default policies
    ufw default deny incoming
    ufw default allow outgoing
    
    # Allow essential services
    ufw allow ssh
    ufw allow 'Nginx Full'
    ufw allow 80/tcp
    ufw allow 443/tcp
    
    # Enable firewall
    ufw --force enable
    
    print_success "Firewall configured successfully"
}

# Function to create SSL certificate (optional)
setup_ssl() {
    print_status "Setting up SSL certificate..."
    
    # Install Certbot
    apt install -y certbot python3-certbot-nginx
    
    # Generate SSL certificate (uncomment if you have a valid domain)
    # certbot --nginx -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email admin@$DOMAIN
    
    print_warning "SSL setup skipped. Run 'certbot --nginx -d $DOMAIN' manually if you have a valid domain"
}

# Function to create monitoring script
create_monitoring() {
    print_status "Creating monitoring script..."
    
    cat > /usr/local/bin/bimtek-monitor.sh <<'EOF'
#!/bin/bash

# Simple monitoring script for Laravel app
LOG_FILE="/var/log/bimtek-monitor.log"
APP_PATH="/var/www/bimtek"

echo "$(date): Checking application health..." >> $LOG_FILE

# Check if services are running
if ! systemctl is-active --quiet nginx; then
    echo "$(date): Nginx is down, restarting..." >> $LOG_FILE
    systemctl restart nginx
fi

if ! systemctl is-active --quiet php8.2-fpm; then
    echo "$(date): PHP-FPM is down, restarting..." >> $LOG_FILE
    systemctl restart php8.2-fpm
fi

if ! systemctl is-active --quiet mariadb; then
    echo "$(date): MariaDB is down, restarting..." >> $LOG_FILE
    systemctl restart mariadb
fi

# Check disk space
DISK_USAGE=$(df /var/www | awk 'NR==2 {print $5}' | sed 's/%//')
if [ $DISK_USAGE -gt 85 ]; then
    echo "$(date): Warning - Disk usage is ${DISK_USAGE}%" >> $LOG_FILE
fi

echo "$(date): Health check completed" >> $LOG_FILE
EOF

    chmod +x /usr/local/bin/bimtek-monitor.sh
    
    # Add to crontab for automatic monitoring every 5 minutes
    (crontab -l 2>/dev/null; echo "*/5 * * * * /usr/local/bin/bimtek-monitor.sh") | crontab -
    
    print_success "Monitoring script created and scheduled"
}

# Function to display final information
display_info() {
    print_success "🎉 Deployment completed successfully!"
    echo
    print_status "Application Information:"
    echo -e "  🌐 URL: http://$DOMAIN"
    echo -e "  📁 Path: $APP_PATH"
    echo -e "  🗄️  Database: $DB_NAME"
    echo -e "  👤 DB User: $DB_USER"
    echo
    print_status "Test Credentials:"
    echo -e "  📧 Email: Any email ending with @organization.xyz"
    echo -e "  🔑 Password: password"
    echo
    print_status "Vulnerability Testing:"
    echo -e "  🚨 Access: Login → Click 'Vulnerabilities' button"
    echo -e "  🎯 IDOR: /vulnerable/post/{id}"
    echo -e "  💉 SQL Injection: /vulnerable/search?query=PAYLOAD"
    echo
    print_warning "Important Security Notes:"
    echo -e "  ⚠️  This application contains intentional vulnerabilities"
    echo -e "  🔒 Use only in isolated training environments"
    echo -e "  🚫 Never expose to public internet for production use"
    echo
    print_status "Next Steps:"
    echo -e "  1. Add '$DOMAIN' to your /etc/hosts file"
    echo -e "  2. Access the application via http://$DOMAIN"
    echo -e "  3. Login and start cybersecurity training"
    echo -e "  4. Monitor logs: /var/log/nginx/ and /var/log/bimtek-monitor.log"
    echo
    print_status "Management Commands:"
    echo -e "  🔄 Restart services: systemctl restart nginx php8.2-fpm mariadb"
    echo -e "  📊 Check status: systemctl status nginx php8.2-fpm mariadb"
    echo -e "  🔍 View logs: tail -f /var/log/nginx/${DOMAIN}_access.log"
}

# Main execution
main() {
    print_status "Starting Laravel Cybersecurity Training App deployment..."
    echo -e "🎯 Target: Ubuntu 24.04 LTS + Nginx + MariaDB + PHP 8.2"
    echo -e "📦 Application: Cybersecurity Training Platform"
    echo -e "👤 Author: Wahyu Sutejo"
    echo
    
    # Confirm before proceeding
    read -p "Do you want to continue with the deployment? (y/N): " -n 1 -r
    echo
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        print_error "Deployment cancelled by user"
        exit 1
    fi
    
    # Execute deployment steps
    check_root
    update_system
    install_packages
    configure_mariadb
    configure_php
    deploy_laravel
    configure_nginx
    configure_firewall
    setup_ssl
    create_monitoring
    display_info
    
    print_success "🚀 Deployment completed! Your cybersecurity training environment is ready!"
}

# Run main function
main "$@"
