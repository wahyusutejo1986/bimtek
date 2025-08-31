# Organization.xyz Business Management Platform

A comprehensive Laravel 8 application featuring modern UI/UX design for enterprise content management and business operations. Built with Jetstream, Livewire, Sanctum, and Tailwind CSS.

## 🎯 Purpose

This application provides a complete business management solution designed for modern organizations, featuring advanced content management, user administration, and system monitoring capabilities in a professional enterprise environment.

## ✨ Features

### Core Application
- **Modern Laravel 8** with Jetstream authentication system
- **Professional UI** with dark theme and animated backgrounds
- **Content Management** for articles, categories, comments, and taxonomies
- **User Directory** and comprehensive user management
- **Media Management** with support for documents and multimedia
- **Responsive Design** optimized for all devices with Tailwind CSS

### Business Services
- **Content Management System** for knowledge base and documentation
- **User Directory Services** with advanced search and filtering
- **Document Upload Center** with secure file management
- **Business Intelligence** dashboard with analytics
- **Professional Workflow** management and collaboration tools

### System Administration Tools
- **User Management** with advanced profile administration
- **Security Management** for credential and access control
- **Data Processing** with advanced search and analytics
- **Account Services** including recovery and management
- **System Monitoring** with comprehensive logging
- **Component Management** for software library oversight

## 🚀 Installation

### Option 1: Automated Ubuntu 24.04 LTS Deployment

**Enterprise deployment with automated configuration:**

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

**Enterprise infrastructure includes:**
- Nginx web server with SSL support
- MariaDB database with optimization
- PHP 8.2 with enterprise extensions
- Node.js 18 for modern asset compilation
- UFW firewall with security policies
- Automated monitoring and logging

📋 **See [DEPLOYMENT.md](DEPLOYMENT.md) for comprehensive deployment guide**

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
   - Login with organization credentials (password: `password`)
   - Example: Use any email ending with `@organization.xyz`

## 🏢 Business Services

### Content Management Dashboard
After logging in, access the **� Services** section on the dashboard to manage business content and operations.

### Available Business Services

#### Content Management
- **Content Viewer**: `/services/content/view` - Access published articles and documentation
- **Content Editor**: `/services/content/edit` - Manage and update business content
- **User Directory**: `/services/profile/view` - Browse organization member profiles

#### Search Services
- **Content Search**: `/services/search/content` - Advanced search through knowledge base
- **User Directory**: `/services/directory/users` - Find and connect with team members

#### File Management
- **Document Center**: `/services/files/manager` - Upload and organize business documents
- **Media Library**: Comprehensive file management and organization system

### System Administration Tools
Access the **🔧 Tools** section for advanced system administration:

#### User Management
- **Profile Manager** - Advanced user profile administration
- **Content Editor** - System-wide content management capabilities

#### Security & Data Management  
- **Credential Manager** - Secure credential and access management
- **Advanced Search** - Powerful database search and analytics
- **Data Access Portal** - Centralized data management interface

#### System Tools
- **Account Recovery** - User account management and recovery services
- **System Diagnostics** - Comprehensive system monitoring and health checks
- **Component Manager** - Software library and dependency management
- **Log Manager** - System logging and audit trail management

## 💼 Enterprise Use Cases

This application is designed for:
- **Business Operations** - Complete content and user management
- **Enterprise Content Management** - Knowledge base and documentation systems  
- **Team Collaboration** - User directory and communication tools
- **System Administration** - Comprehensive administrative capabilities

## 🔒 Security & Compliance

- **Enterprise Security** - Professional authentication and authorization
- **Data Protection** - Secure file upload and management
- **Audit Trails** - Comprehensive logging and monitoring
- **Access Control** - Role-based permission management

## 🛠️ Technology Stack

- **Backend**: Laravel 8, PHP 8.0+
- **Frontend**: Livewire, Tailwind CSS, JavaScript
- **Authentication**: Laravel Jetstream with Sanctum
- **Database**: MySQL/MariaDB
- **Development**: Laravel Mix, Webpack

## 🔧 Production Management

### Server Management (Ubuntu/Linux)

After enterprise deployment, use the maintenance script for system administration:

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

# Reset database with fresh business data
sudo ./maintain.sh reset

# View application and server logs
sudo ./maintain.sh logs

# Run system health and security checks
sudo ./maintain.sh security

# Test system endpoints and functionality
sudo ./maintain.sh system-check

# Manage business users and accounts
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

### Professional Business Interface
The application features a modern professional interface with dark theme and sophisticated UI components optimized for business operations.

### System Administration Dashboard
Comprehensive administrative interface with enterprise-grade management tools and real-time monitoring capabilities.

### Business Management Features
Professional presentation suitable for enterprise environments and business operations management.

## 👤 Author

**Wahyu Sutejo**
- GitHub: [@wahyusutejo1986](https://github.com/wahyusutejo1986)
- Email: wahyusutejo1986@gmail.com
- Purpose: Enterprise Business Management Solutions

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome for business feature improvements and enterprise functionality enhancements. Please ensure all contributions maintain the professional business focus and include proper documentation.

## 🙏 Acknowledgments

This project was created for modern business management and enterprise operations. Special thanks to the business community for promoting efficient organizational management solutions.

---

**Professional Business Application**: This enterprise-grade platform provides comprehensive business management capabilities for modern organizations.
