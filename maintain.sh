#!/bin/bash

# Laravel Cybersecurity Training App - Maintenance Script
# Author: Wahyu Sutejo
# Purpose: Maintenance and management tasks for the training environment

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

# Configuration
APP_PATH="/var/www/bimtek"
DB_NAME="bimtek_db"
DB_USER="bimtek_user"
BACKUP_PATH="/var/backups/bimtek"

print_status() { echo -e "${BLUE}[INFO]${NC} $1"; }
print_success() { echo -e "${GREEN}[SUCCESS]${NC} $1"; }
print_warning() { echo -e "${YELLOW}[WARNING]${NC} $1"; }
print_error() { echo -e "${RED}[ERROR]${NC} $1"; }

show_usage() {
    echo "Laravel Cybersecurity Training App - Maintenance Script"
    echo
    echo "Usage: $0 [COMMAND]"
    echo
    echo "Commands:"
    echo "  status          Show application and services status"
    echo "  restart         Restart all services"
    echo "  update          Update application from repository"
    echo "  backup          Create database and files backup"
    echo "  restore         Restore from backup"
    echo "  reset           Reset database with fresh data"
    echo "  logs            Show application logs"
    echo "  security        Run security checks"
    echo "  optimize        Optimize application performance"
    echo "  health          Run health checks"
    echo "  users           Manage test users"
    echo "  vulnerabilities Test vulnerability endpoints"
    echo "  help            Show this help message"
    echo
}

check_root() {
    if [[ $EUID -ne 0 ]]; then
        print_error "This script must be run as root (use sudo)"
        exit 1
    fi
}

show_status() {
    print_status "Checking application status..."
    echo
    
    # Service status
    echo "🔧 Services Status:"
    services=("nginx" "php8.2-fpm" "mariadb")
    for service in "${services[@]}"; do
        if systemctl is-active --quiet $service; then
            echo -e "  ✅ $service: ${GREEN}Running${NC}"
        else
            echo -e "  ❌ $service: ${RED}Stopped${NC}"
        fi
    done
    echo
    
    # Disk usage
    echo "💾 Disk Usage:"
    df -h $APP_PATH | awk 'NR==2 {printf "  📁 Application: %s used (%s available)\n", $5, $4}'
    df -h /var/log | awk 'NR==2 {printf "  📋 Logs: %s used (%s available)\n", $5, $4}'
    echo
    
    # Database status
    echo "🗄️  Database Status:"
    if systemctl is-active --quiet mariadb; then
        DB_SIZE=$(mysql -u$DB_USER -p$(grep DB_PASSWORD $APP_PATH/.env | cut -d'=' -f2) -e "SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'DB Size (MB)' FROM information_schema.tables WHERE table_schema='$DB_NAME';" | tail -1)
        echo -e "  📊 Database size: ${DB_SIZE} MB"
        
        USER_COUNT=$(mysql -u$DB_USER -p$(grep DB_PASSWORD $APP_PATH/.env | cut -d'=' -f2) $DB_NAME -e "SELECT COUNT(*) FROM users;" | tail -1)
        echo -e "  👥 Total users: $USER_COUNT"
        
        POST_COUNT=$(mysql -u$DB_USER -p$(grep DB_PASSWORD $APP_PATH/.env | cut -d'=' -f2) $DB_NAME -e "SELECT COUNT(*) FROM posts;" | tail -1)
        echo -e "  📝 Total posts: $POST_COUNT"
    else
        echo -e "  ❌ Database not accessible"
    fi
    echo
    
    # Application status
    echo "🚀 Application Status:"
    if [ -f "$APP_PATH/.env" ]; then
        APP_ENV=$(grep APP_ENV $APP_PATH/.env | cut -d'=' -f2)
        APP_DEBUG=$(grep APP_DEBUG $APP_PATH/.env | cut -d'=' -f2)
        echo -e "  🌍 Environment: $APP_ENV"
        echo -e "  🐛 Debug mode: $APP_DEBUG"
    fi
    
    # Last deployment
    if [ -d "$APP_PATH/.git" ]; then
        LAST_COMMIT=$(cd $APP_PATH && git log -1 --format="%h - %s (%cr)")
        echo -e "  📦 Last commit: $LAST_COMMIT"
    fi
}

restart_services() {
    print_status "Restarting all services..."
    
    systemctl restart nginx
    systemctl restart php8.2-fpm
    systemctl restart mariadb
    
    # Wait for services to start
    sleep 5
    
    # Check if all services are running
    if systemctl is-active --quiet nginx && systemctl is-active --quiet php8.2-fpm && systemctl is-active --quiet mariadb; then
        print_success "All services restarted successfully"
    else
        print_error "Some services failed to restart"
        show_status
    fi
}

update_application() {
    print_status "Updating application from repository..."
    
    cd $APP_PATH
    
    # Backup current state
    create_backup
    
    # Pull latest changes
    git pull origin main
    
    # Update dependencies
    composer install --no-dev --optimize-autoloader
    npm install
    npm run production
    
    # Run migrations
    php artisan migrate --force
    
    # Clear caches
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    # Set permissions
    chown -R www-data:www-data $APP_PATH
    chmod -R 755 $APP_PATH
    chmod -R 775 $APP_PATH/storage
    chmod -R 775 $APP_PATH/bootstrap/cache
    
    print_success "Application updated successfully"
}

create_backup() {
    print_status "Creating backup..."
    
    # Create backup directory
    mkdir -p $BACKUP_PATH
    
    TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
    BACKUP_FILE="$BACKUP_PATH/bimtek_backup_$TIMESTAMP"
    
    # Database backup
    DB_PASSWORD=$(grep DB_PASSWORD $APP_PATH/.env | cut -d'=' -f2)
    mysqldump -u$DB_USER -p$DB_PASSWORD $DB_NAME > "$BACKUP_FILE.sql"
    
    # Application files backup (excluding node_modules and vendor)
    tar --exclude='node_modules' --exclude='vendor' --exclude='.git' -czf "$BACKUP_FILE.tar.gz" -C /var/www bimtek
    
    print_success "Backup created: $BACKUP_FILE.{sql,tar.gz}"
    
    # Clean old backups (keep last 7 days)
    find $BACKUP_PATH -name "bimtek_backup_*" -mtime +7 -delete
}

reset_database() {
    print_status "Resetting database with fresh data..."
    
    cd $APP_PATH
    
    # Reset database
    php artisan migrate:fresh --seed --force
    
    print_success "Database reset completed"
    print_warning "All previous data has been lost"
}

show_logs() {
    echo "📋 Application Logs:"
    echo
    echo "1️⃣  Laravel Error Log:"
    tail -20 $APP_PATH/storage/logs/laravel.log 2>/dev/null || echo "No Laravel logs found"
    echo
    echo "2️⃣  Nginx Access Log:"
    tail -10 /var/log/nginx/*_access.log 2>/dev/null || echo "No Nginx access logs found"
    echo
    echo "3️⃣  Nginx Error Log:"
    tail -10 /var/log/nginx/*_error.log 2>/dev/null || echo "No Nginx error logs found"
    echo
    echo "4️⃣  PHP-FPM Log:"
    tail -10 /var/log/php8.2-fpm.log 2>/dev/null || echo "No PHP-FPM logs found"
}

run_security_checks() {
    print_status "Running security checks..."
    echo
    
    # Check file permissions
    echo "🔒 File Permissions:"
    if [ "$(stat -c %a $APP_PATH/.env)" = "644" ]; then
        echo -e "  ✅ .env permissions: OK"
    else
        echo -e "  ⚠️  .env permissions: $(stat -c %a $APP_PATH/.env) (should be 644)"
    fi
    
    # Check for common security issues
    echo
    echo "🛡️  Security Configuration:"
    
    if grep -q "APP_DEBUG=false" $APP_PATH/.env; then
        echo -e "  ✅ Debug mode: Disabled"
    else
        echo -e "  ⚠️  Debug mode: Enabled (disable for production)"
    fi
    
    if grep -q "APP_ENV=production" $APP_PATH/.env; then
        echo -e "  ✅ Environment: Production"
    else
        echo -e "  ⚠️  Environment: Not production"
    fi
    
    # Check SSL
    echo
    echo "🔐 SSL Status:"
    if [ -f "/etc/letsencrypt/live/*/fullchain.pem" ]; then
        echo -e "  ✅ SSL Certificate: Installed"
    else
        echo -e "  ⚠️  SSL Certificate: Not found"
    fi
}

optimize_performance() {
    print_status "Optimizing application performance..."
    
    cd $APP_PATH
    
    # Clear all caches
    php artisan cache:clear
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    
    # Optimize Composer autoloader
    composer dump-autoload --optimize
    
    # Clear logs older than 30 days
    find $APP_PATH/storage/logs -name "*.log" -mtime +30 -delete
    
    print_success "Performance optimization completed"
}

manage_users() {
    print_status "User Management"
    echo
    echo "Available actions:"
    echo "1. List all users"
    echo "2. Create test user"
    echo "3. Reset user password"
    echo
    read -p "Select action (1-3): " action
    
    case $action in
        1)
            mysql -u$DB_USER -p$(grep DB_PASSWORD $APP_PATH/.env | cut -d'=' -f2) $DB_NAME -e "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC LIMIT 10;"
            ;;
        2)
            read -p "Enter username: " username
            read -p "Enter email: " email
            cd $APP_PATH
            php artisan tinker --execute="User::create(['name' => '$username', 'email' => '$email', 'password' => Hash::make('password')]);"
            print_success "User created with password: password"
            ;;
        3)
            read -p "Enter user email: " email
            cd $APP_PATH
            php artisan tinker --execute="User::where('email', '$email')->update(['password' => Hash::make('password')]);"
            print_success "Password reset to: password"
            ;;
        *)
            print_error "Invalid selection"
            ;;
    esac
}

test_vulnerabilities() {
    print_status "Testing vulnerability endpoints..."
    echo
    
    DOMAIN=$(grep APP_URL $APP_PATH/.env | cut -d'=' -f2 | sed 's|http://||')
    
    echo "🎯 Vulnerability Endpoints:"
    echo "  📝 IDOR - Post Access: http://$DOMAIN/vulnerable/post/1"
    echo "  ✏️  IDOR - Post Edit: http://$DOMAIN/vulnerable/post/edit/1"
    echo "  👤 IDOR - User Profile: http://$DOMAIN/vulnerable/user/1"
    echo "  💉 SQL Injection - Search: http://$DOMAIN/vulnerable/search?query=' OR 1=1 --"
    echo "  👥 SQL Injection - Users: http://$DOMAIN/vulnerable/users?name=' OR 1=1 --"
    echo
    echo "🔗 Test with curl:"
    echo "  curl -k \"http://$DOMAIN/vulnerable/search?query=' OR 1=1 --\""
    echo
    print_warning "These endpoints contain intentional vulnerabilities for training purposes"
}

# Main execution
case "${1:-help}" in
    status)
        show_status
        ;;
    restart)
        check_root
        restart_services
        ;;
    update)
        check_root
        update_application
        ;;
    backup)
        check_root
        create_backup
        ;;
    reset)
        check_root
        reset_database
        ;;
    logs)
        show_logs
        ;;
    security)
        run_security_checks
        ;;
    optimize)
        check_root
        optimize_performance
        ;;
    health)
        show_status
        run_security_checks
        ;;
    users)
        check_root
        manage_users
        ;;
    vulnerabilities)
        test_vulnerabilities
        ;;
    help|*)
        show_usage
        ;;
esac
