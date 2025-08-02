# Step 1: Installation and Setup

## 🚀 Laravel Project Setup

### **1.1 Create Laravel Project with Breeze**

```bash
# Install Laravel installer globally (allows you to use 'laravel' command)
composer global require laravel/installer

# Create a new Laravel project
composer create-project laravel/laravel articles-app
# OR if you have Laravel installer: laravel new articles-app

# Navigate to project directory
cd articles-app

# Install Laravel Breeze for authentication scaffolding
composer require laravel/breeze --dev

# Install Breeze with Blade templates
php artisan breeze:install blade
```

#### **🔍 What Each Command Does:**

- **`composer global require laravel/installer`**: Installs Laravel globally so you can use the `laravel` command anywhere in your system
- **`composer create-project laravel/laravel articles-app`**: Creates a new Laravel project with all dependencies
- **`laravel new articles-app`**: Alternative method if you have the Laravel installer (faster)
- **`composer require laravel/breeze --dev`**: Adds Breeze package for simple authentication
- **`php artisan breeze:install blade`**: Sets up authentication views using Blade templating engine

### **1.2 Install Dependencies**

```bash
# Install Node.js dependencies (Bootstrap, Vite, etc.)
npm install

# Build assets for production (compiles CSS/JS)
npm run build
```

#### **🔍 What Each Command Does:**

- **`npm install`**: Installs all Node.js dependencies defined in `package.json` (Bootstrap, Vite, etc.)
- **`npm run build`**: Compiles and optimizes CSS/JS files for production use

### **1.3 Verify Installation**

```bash
# Start the development server
php artisan serve

# Check if the application is running
# Open http://localhost:8000 in your browser
```

---

## 📝 الشرح بالعربية - Installation & Setup

**خطوات التثبيت والإعداد:**
- **إنشاء مشروع Laravel**: استخدام Composer لإنشاء مشروع جديد
- **تثبيت Breeze**: إضافة نظام المصادقة الجاهز
- **تثبيت Bootstrap**: إضافة إطار العمل للتصميم
- **بناء الأصول**: تجميع ملفات CSS و JavaScript

**الأوامر المهمة:**
- `composer create-project`: إنشاء مشروع Laravel جديد
- `php artisan breeze:install`: تثبيت نظام المصادقة
- `npm install`: تثبيت حزم Node.js
- `npm run build`: بناء الملفات للإنتاج

---

## ✅ Checklist

- [ ] Laravel project created
- [ ] Breeze authentication installed
- [ ] Node.js dependencies installed
- [ ] Assets built successfully
- [ ] Development server running
- [ ] Application accessible in browser

---

## 🚨 Common Issues & Solutions

### **Issue: Composer not found**
```bash
# Install Composer globally
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### **Issue: Node.js not installed**
```bash
# Install Node.js (Ubuntu/Debian)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install Node.js (Windows)
# Download from https://nodejs.org/
```

### **Issue: Permission denied**
```bash
# Fix permissions (Linux/Mac)
sudo chown -R $USER:$USER .
chmod -R 755 storage bootstrap/cache
```

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Database Configuration** - Set up your database connection
2. **Bootstrap Integration** - Add Bootstrap to your project
3. **Environment Setup** - Configure your `.env` file

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 