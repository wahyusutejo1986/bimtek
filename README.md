# Laravel News Application for Cybersecurity Training

A comprehensive Laravel 8 application featuring modern UI/UX design and intentional security vulnerabilities for educational purposes. Built with Jetstream, Livewire, Sanctum, and Tailwind CSS.

## 🎯 Purpose

This application is specifically designed for cybersecurity training and educational purposes, containing real-world vulnerabilities that security professionals can practice identifying and exploiting in a safe environment.

## ✨ Features

### Core Application
- **Modern Laravel 8** with Jetstream authentication
- **Dark Theme UI** with animated backgrounds and particle effects
- **Content Management** for posts, categories, comments, and tags
- **User Authentication** and role management
- **Media Support** for images and videos
- **Responsive Design** with Tailwind CSS

### Security Vulnerabilities (Educational)
- **IDOR (Insecure Direct Object Reference)** vulnerabilities
- **SQL Injection** vulnerabilities with multiple attack vectors
- **Information Disclosure** through error messages
- **Professional Testing Interface** for vulnerability demonstration

## 🚀 Installation

### Option 1: Automated Ubuntu 24.04 LTS Deployment

**Quick deployment with automated script:**

1. **Download and run deployment script:**
   ```bash
   wget https://raw.githubusercontent.com/wahyusutejo1986/bimtek/main/deploy.sh
   chmod +x deploy.sh
   sudo ./deploy.sh
   ```

2. **Access the application:**
   ```bash
   echo "127.0.0.1 bimtek.local" | sudo tee -a /etc/hosts
   ```
   - Visit: `http://bimtek.local`
   - Login: Any email ending with `@organization.xyz`, password: `password`

**What gets installed:**
- Nginx web server
- MariaDB database
- PHP 8.2 with all extensions
- Node.js 18 for asset compilation
- UFW firewall configuration
- Automated monitoring

📋 **See [DEPLOYMENT.md](DEPLOYMENT.md) for detailed deployment guide**

### Option 2: Manual Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/wahyusutejo1986/bimtek.git
   cd bimtek
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Set your database credentials in `.env` file
   - Run migrations and seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Storage and assets**
   ```bash
   php artisan storage:link
   npm run dev
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   - Visit `http://localhost:8000`
   - Login with any seeded user (password: `password`)
   - Example: Use any email ending with `@organization.xyz`

## 🔒 Security Testing

### Access Vulnerability Dashboard
After logging in, click the **🚨 Vulnerabilities** button on the dashboard to access the security testing interface.

### Available Vulnerabilities

#### IDOR (Insecure Direct Object Reference)
- **Post Access**: `/vulnerable/post/{id}` - View any post without authorization
- **Post Editing**: `/vulnerable/post/edit/{id}` - Edit any post without ownership check
- **User Profiles**: `/vulnerable/user/{id}` - Access any user's sensitive information

#### SQL Injection
- **Post Search**: `/vulnerable/search?query=PAYLOAD` - Direct string concatenation
- **User Search**: `/vulnerable/users?name=PAYLOAD` - Unfiltered input processing

### Sample Payloads
```sql
-- Basic injection
' OR 1=1 --

-- Union injection
' UNION SELECT id,email,password,created_at FROM users --

-- Boolean injection
' OR '1'='1

-- Information extraction
' UNION SELECT DATABASE(),VERSION(),USER(),NOW() --
```

## 🎓 Educational Use

This application is designed for:
- **Cybersecurity Training** courses and workshops
- **Penetration Testing** practice and skill development
- **Security Awareness** training for developers
- **Academic Research** in web application security

## ⚠️ Important Warnings

- **FOR EDUCATIONAL USE ONLY** - Never deploy to production
- **CONTAINS REAL VULNERABILITIES** - Use only in isolated environments
- **NO WARRANTY** - Use at your own risk for training purposes

## 🛠️ Technology Stack

- **Backend**: Laravel 8, PHP 8.0+
- **Frontend**: Livewire, Tailwind CSS, JavaScript
- **Authentication**: Laravel Jetstream with Sanctum
- **Database**: MySQL/MariaDB
- **Development**: Laravel Mix, Webpack

## 🔧 Production Management

### Server Management (Ubuntu/Linux)

After automated deployment, use the maintenance script:

```bash
# Download maintenance script (if not already deployed)
wget https://raw.githubusercontent.com/wahyusutejo1986/bimtek/main/maintain.sh
chmod +x maintain.sh

# Check application status
sudo ./maintain.sh status

# Restart all services
sudo ./maintain.sh restart

# Update application from repository
sudo ./maintain.sh update

# Create database and files backup
sudo ./maintain.sh backup

# Reset database with fresh training data
sudo ./maintain.sh reset

# View application and server logs
sudo ./maintain.sh logs

# Run security and health checks
sudo ./maintain.sh security

# Test vulnerability endpoints
sudo ./maintain.sh vulnerabilities

# Manage training users
sudo ./maintain.sh users
```

### Key Locations
- **Application**: `/var/www/bimtek`
- **Nginx Config**: `/etc/nginx/sites-available/bimtek.local`
- **Logs**: `/var/log/nginx/`, `/var/log/bimtek-monitor.log`
- **Backups**: `/var/backups/bimtek/`

### Service Commands
```bash
# Check service status
sudo systemctl status nginx php8.2-fpm mariadb

# Restart services
sudo systemctl restart nginx php8.2-fpm mariadb

# View live logs
sudo tail -f /var/log/nginx/bimtek.local_access.log
sudo tail -f /var/www/bimtek/storage/logs/laravel.log
```

## 📱 Screenshots

### Modern Dark Theme Interface
The application features a professional dark theme with animated backgrounds and modern UI components.

### Vulnerability Testing Dashboard
Comprehensive testing interface with exploit examples and real-time results display.

### Security Training Features
Professional presentation suitable for cybersecurity courses and demonstrations.

## 👤 Author

**Wahyu Sutejo**
- GitHub: [@wahyusutejo1986](https://github.com/wahyusutejo1986)
- Email: wahyusutejo1986@gmail.com
- Purpose: Cybersecurity Training and Education

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome for educational improvements and additional vulnerability examples. Please ensure all contributions maintain the educational focus and include proper documentation.

## 🙏 Acknowledgments

This project was created specifically for cybersecurity education and training purposes. Special thanks to the cybersecurity community for promoting safe learning environments.

---

**Remember**: This application contains intentional security vulnerabilities for educational purposes. Always use responsibly and only in controlled environments.
