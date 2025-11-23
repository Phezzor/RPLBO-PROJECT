# 🚀 Deployment Checklist - Sidewalk.Go Dashboard

## 📋 Pre-Deployment Checklist

### 1. Environment Setup
- [ ] Copy `.env.example` to `.env`
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate `APP_KEY` dengan `php artisan key:generate`
- [ ] Generate `JWT_SECRET` dengan `php artisan jwt:secret`
- [ ] Set database credentials yang benar
- [ ] Set `APP_URL` sesuai domain production

### 2. Database
- [ ] Database PostgreSQL sudah dibuat
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Seed data jika diperlukan: `php artisan db:seed`
- [ ] Backup database sebelum deploy
- [ ] Test koneksi database

### 3. Dependencies
- [ ] Install PHP dependencies: `composer install --optimize-autoloader --no-dev`
- [ ] Install Node dependencies: `npm install`
- [ ] Build production assets: `npm run build`
- [ ] Verify semua packages terinstall

### 4. Security
- [ ] HTTPS enabled (SSL certificate)
- [ ] CSRF protection enabled
- [ ] JWT secret configured
- [ ] CORS settings configured di `config/cors.php`
- [ ] Rate limiting configured
- [ ] File permissions set correctly (755 for directories, 644 for files)
- [ ] Storage dan cache directories writable

### 5. Performance
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`
- [ ] Cache views: `php artisan view:cache`
- [ ] Optimize autoloader: `composer dump-autoload --optimize`
- [ ] Enable OPcache di PHP
- [ ] Set up Redis/Memcached untuk caching (optional)

### 6. Assets
- [ ] Build production assets: `npm run build`
- [ ] Verify assets di `public/build` directory
- [ ] Test asset loading di browser
- [ ] Enable CDN untuk static assets (optional)

### 7. Logging & Monitoring
- [ ] Configure logging di `.env`
- [ ] Set up error tracking (Sentry, Bugsnag, etc.)
- [ ] Configure log rotation
- [ ] Set up application monitoring
- [ ] Test error logging

### 8. Testing
- [ ] Run all tests: `php artisan test`
- [ ] Test login functionality
- [ ] Test all dashboard pages
- [ ] Test API endpoints
- [ ] Test role-based access control
- [ ] Test responsive design
- [ ] Cross-browser testing

## 🔧 Server Configuration

### Nginx Configuration
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/BE-API-SW/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Apache Configuration (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### PHP Configuration (php.ini)
```ini
upload_max_filesize = 20M
post_max_size = 20M
memory_limit = 256M
max_execution_time = 300
opcache.enable = 1
opcache.memory_consumption = 128
opcache.max_accelerated_files = 10000
```

## 📦 Deployment Steps

### Step 1: Upload Files
```bash
# Via Git
git clone https://github.com/your-repo/BE-API-SW.git
cd BE-API-SW

# Atau via FTP/SFTP
# Upload semua files kecuali:
# - node_modules/
# - vendor/
# - .env
# - storage/logs/*
```

### Step 2: Set Permissions
```bash
# Set ownership
sudo chown -R www-data:www-data /var/www/BE-API-SW

# Set permissions
sudo find /var/www/BE-API-SW -type f -exec chmod 644 {} \;
sudo find /var/www/BE-API-SW -type d -exec chmod 755 {} \;

# Storage dan cache writable
sudo chmod -R 775 storage bootstrap/cache
```

### Step 3: Install Dependencies
```bash
# PHP dependencies
composer install --optimize-autoloader --no-dev

# Node dependencies
npm install

# Build assets
npm run build
```

### Step 4: Configure Environment
```bash
# Copy environment file
cp .env.example .env

# Edit .env file
nano .env

# Generate keys
php artisan key:generate
php artisan jwt:secret
```

### Step 5: Database Setup
```bash
# Run migrations
php artisan migrate --force

# Seed data (if needed)
php artisan db:seed --force
```

### Step 6: Optimize
```bash
# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 7: Restart Services
```bash
# Restart PHP-FPM
sudo systemctl restart php8.2-fpm

# Restart Nginx
sudo systemctl restart nginx

# Restart Queue Worker (if using)
sudo systemctl restart laravel-worker
```

## ✅ Post-Deployment Verification

### Functional Testing
- [ ] Access homepage: `https://yourdomain.com`
- [ ] Login page loads correctly
- [ ] Can login with valid credentials
- [ ] Dashboard displays correctly
- [ ] All menu items accessible
- [ ] Charts render properly
- [ ] API endpoints working
- [ ] Forms submit successfully
- [ ] Logout works

### Performance Testing
- [ ] Page load time < 3 seconds
- [ ] Assets loading from CDN (if configured)
- [ ] Database queries optimized
- [ ] No console errors
- [ ] No 404 errors for assets

### Security Testing
- [ ] HTTPS working
- [ ] CSRF protection working
- [ ] JWT authentication working
- [ ] Role-based access working
- [ ] SQL injection protected
- [ ] XSS protection enabled

## 🔄 Rollback Plan

Jika terjadi masalah:

```bash
# 1. Restore database backup
psql -U postgres -d SistemDatabaseSidewalkgo < backup.sql

# 2. Revert to previous version
git checkout previous-stable-tag

# 3. Reinstall dependencies
composer install --no-dev
npm install
npm run build

# 4. Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Restart services
sudo systemctl restart php8.2-fpm nginx
```

## 📊 Monitoring

### What to Monitor
- [ ] Server CPU & Memory usage
- [ ] Database connections
- [ ] Response times
- [ ] Error rates
- [ ] Disk space
- [ ] SSL certificate expiry

### Tools
- **Server**: New Relic, Datadog, Prometheus
- **Application**: Laravel Telescope, Debugbar (dev only)
- **Uptime**: UptimeRobot, Pingdom
- **Logs**: Papertrail, Loggly

## 🆘 Emergency Contacts

```
Developer: [Your Name]
Email: [your-email@example.com]
Phone: [your-phone]

Server Admin: [Admin Name]
Email: [admin-email@example.com]
Phone: [admin-phone]
```

## 📝 Maintenance Mode

```bash
# Enable maintenance mode
php artisan down --message="Sedang maintenance, akan kembali dalam 30 menit"

# Disable maintenance mode
php artisan up
```

## 🎉 Deployment Complete!

Setelah semua checklist selesai, dashboard siap digunakan di production!

**Last Updated**: November 2025  
**Version**: 1.0.0

