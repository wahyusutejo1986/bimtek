# Ubuntu 24.04 LTS Deployment Guide
## Laravel Cybersecurity Training Application

### 🚀 Quick Start

1. **Download the deployment script:**
   ```bash
   wget https://raw.githubusercontent.com/wahyusutejo1986/bimtek/main/deploy.sh
   chmod +x deploy.sh
   ```

2. **Run the deployment:**
   ```bash
   sudo ./deploy.sh
   ```

3. **Access the application:**
   - Add to `/etc/hosts`: `127.0.0.1 bimtek.local`
   - Visit: `http://bimtek.local`
   - Login: Any email ending with `@organization.xyz`, password: `password`

### 📋 Prerequisites

- Ubuntu 24.04 LTS (fresh installation recommended)
- Root or sudo access
- Minimum 2GB RAM, 20GB disk space
- Internet connection for package downloads

### 🔧 What Gets Installed

- **Nginx** - Web server
- **MariaDB** - Database server
- **PHP 8.2** - With all required extensions
- **Node.js 18** - For asset compilation
- **Composer** - PHP dependency manager
- **UFW Firewall** - Basic security
- **Monitoring Script** - Automated health checks

### 🎯 Default Configuration

```bash
Domain: bimtek.local
Database: bimtek_db
DB User: bimtek_user
DB Password: SecurePassword123! (CHANGE THIS!)
App Path: /var/www/bimtek
SSL: Not configured (optional)
```

### 🛠️ Customization

1. **Edit configuration before deployment:**
   ```bash
   nano deploy.config
   ```

2. **Important settings to change:**
   - `DB_PASSWORD` - Use a strong password
   - `DOMAIN` - Your actual domain name
   - `SSL_EMAIL` - Your email for SSL certificates

### 🔒 Security Notes

⚠️ **CRITICAL WARNINGS:**
- This application contains **intentional vulnerabilities**
- **NEVER** deploy to public internet
- Use only in **isolated training environments**
- All vulnerable endpoints require authentication

### 📊 Management Commands

After deployment, use the maintenance script:

```bash
# Download maintenance script
wget https://raw.githubusercontent.com/wahyusutejo1986/bimtek/main/maintain.sh
chmod +x maintain.sh

# Check application status
sudo ./maintain.sh status

# Restart all services
sudo ./maintain.sh restart

# Update application
sudo ./maintain.sh update

# Create backup
sudo ./maintain.sh backup

# Reset database
sudo ./maintain.sh reset

# View logs
sudo ./maintain.sh logs

# Security checks
sudo ./maintain.sh security

# Test vulnerabilities
sudo ./maintain.sh vulnerabilities
```

### 🎓 Training Features

#### IDOR Vulnerabilities
- **Post Access**: `/vulnerable/post/{id}`
- **Post Editing**: `/vulnerable/post/edit/{id}`
- **User Profiles**: `/vulnerable/user/{id}`

#### SQL Injection
- **Search Posts**: `/vulnerable/search?query=PAYLOAD`
- **Search Users**: `/vulnerable/users?name=PAYLOAD`

#### Sample Payloads
```sql
' OR 1=1 --
' UNION SELECT id,email,password,created_at FROM users --
' OR '1'='1
```

### 🔍 Monitoring

- **Health Checks**: Automated every 5 minutes
- **Log Files**: `/var/log/nginx/`, `/var/log/bimtek-monitor.log`
- **Service Status**: `systemctl status nginx php8.2-fpm mariadb`

### 🆘 Troubleshooting

#### Services not starting
```bash
sudo systemctl restart nginx php8.2-fpm mariadb
sudo ./maintain.sh status
```

#### Database connection issues
```bash
sudo mysql -u root -p
# Check user permissions
```

#### Permission problems
```bash
sudo chown -R www-data:www-data /var/www/bimtek
sudo chmod -R 755 /var/www/bimtek
sudo chmod -R 775 /var/www/bimtek/storage
```

#### Application errors
```bash
sudo ./maintain.sh logs
tail -f /var/www/bimtek/storage/logs/laravel.log
```

### 🔄 Updates

To update the application:
```bash
sudo ./maintain.sh update
```

Or manually:
```bash
cd /var/www/bimtek
git pull origin main
composer install --no-dev --optimize-autoloader
npm install && npm run production
php artisan migrate --force
php artisan config:cache
```

### 🗂️ File Locations

- **Application**: `/var/www/bimtek`
- **Nginx Config**: `/etc/nginx/sites-available/bimtek.local`
- **PHP Config**: `/etc/php/8.2/fpm/php.ini`
- **Database Config**: `/etc/mysql/mariadb.conf.d/`
- **Logs**: `/var/log/nginx/`, `/var/log/bimtek-monitor.log`
- **Backups**: `/var/backups/bimtek/`

### 📞 Support

For issues or questions:
- GitHub: https://github.com/wahyusutejo1986/bimtek
- Author: Wahyu Sutejo (wahyusutejo1986@gmail.com)

### 📄 License

This project is open-source under the MIT License.

---

**Remember**: This is a cybersecurity training application with intentional vulnerabilities. Use responsibly and only in controlled environments!
