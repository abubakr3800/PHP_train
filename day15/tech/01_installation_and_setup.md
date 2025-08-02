# 🚀 Step 1: Installation and Setup - Teaching System

## 📋 Overview

This step covers creating a new Laravel project specifically for the Teaching System, installing Laravel Breeze for authentication, and setting up the basic project structure.

**الخطوة الأولى: التثبيت والإعداد - نظام التدريس**

**نظرة عامة**
تغطي هذه الخطوة إنشاء مشروع Laravel جديد خصيصاً لنظام التدريس، تثبيت Laravel Breeze للمصادقة، وإعداد هيكل المشروع الأساسي.

---

## 🎯 What You'll Learn

- Create a new Laravel project for Teaching System
- Install Laravel Breeze for authentication
- Install Node.js dependencies
- Build frontend assets
- Verify the installation

**ما ستتعلمه**
- إنشاء مشروع Laravel جديد لنظام التدريس
- تثبيت Laravel Breeze للمصادقة
- تثبيت تبعيات Node.js
- بناء أصول الواجهة الأمامية
- التحقق من التثبيت

---

## 📝 Step-by-Step Instructions

### 1. Create Laravel Project

```bash
# Create new Laravel project for Teaching System
composer create-project laravel/laravel teaching-system

# Navigate to project directory
cd teaching-system
```

**Create Laravel Project - إنشاء مشروع Laravel**
```bash
# إنشاء مشروع Laravel جديد لنظام التدريس
composer create-project laravel/laravel teaching-system

# الانتقال إلى مجلد المشروع
cd teaching-system
```

### 2. Install Laravel Breeze

```bash
# Install Laravel Breeze for authentication
composer require laravel/breeze --dev

# Install Breeze with Blade scaffolding
php artisan breeze:install blade
```

**Install Laravel Breeze - تثبيت Laravel Breeze**
```bash
# تثبيت Laravel Breeze للمصادقة
composer require laravel/breeze --dev

# تثبيت Breeze مع Blade scaffolding
php artisan breeze:install blade
```

### 3. Install Node.js Dependencies

```bash
# Install Node.js dependencies
npm install

# Build assets for development
npm run build
```

**Install Node.js Dependencies - تثبيت تبعيات Node.js**
```bash
# تثبيت تبعيات Node.js
npm install

# بناء الأصول للتطوير
npm run build
```

### 4. Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

**Configure Environment - تكوين البيئة**
```bash
# نسخ ملف البيئة
cp .env.example .env

# توليد مفتاح التطبيق
php artisan key:generate
```

### 5. Verify Installation

```bash
# Start development server
php artisan serve

# In another terminal, watch for asset changes
npm run dev
```

**Verify Installation - التحقق من التثبيت**
```bash
# بدء خادم التطوير
php artisan serve

# في terminal آخر، مراقبة تغييرات الأصول
npm run dev
```

---

## ✅ Checklist

- [ ] Laravel project created (`teaching-system`)
- [ ] Laravel Breeze installed and configured
- [ ] Node.js dependencies installed
- **npm install** completed
- **npm run build** completed
- [ ] Environment file configured
- [ ] Application key generated
- [ ] Development server running
- [ ] Asset compilation working

**قائمة التحقق**
- [ ] تم إنشاء مشروع Laravel (`teaching-system`)
- [ ] تم تثبيت وتكوين Laravel Breeze
- [ ] تم تثبيت تبعيات Node.js
- **npm install** مكتمل
- **npm run build** مكتمل
- [ ] تم تكوين ملف البيئة
- [ ] تم توليد مفتاح التطبيق
- [ ] خادم التطوير يعمل
- [ ] تجميع الأصول يعمل

---

## 🔧 Common Issues & Solutions

### Issue: Composer not found
**Solution:**
```bash
# Install Composer globally
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Issue: Node.js not installed
**Solution:**
```bash
# Install Node.js (Ubuntu/Debian)
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install Node.js (Windows)
# Download from https://nodejs.org/
```

### Issue: Permission denied
**Solution:**
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache
```

### Issue: npm run build fails
**Solution:**
```bash
# Clear npm cache
npm cache clean --force

# Delete node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

**المشاكل الشائعة والحلول**

### المشكلة: Composer غير موجود
**الحل:**
```bash
# تثبيت Composer عالمياً
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### المشكلة: Node.js غير مثبت
**الحل:**
```bash
# تثبيت Node.js (Ubuntu/Debian)
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# تثبيت Node.js (Windows)
# تحميل من https://nodejs.org/
```

### المشكلة: رفض الإذن
**الحل:**
```bash
# إصلاح أذونات التخزين
chmod -R 775 storage bootstrap/cache
```

### المشكلة: فشل npm run build
**الحل:**
```bash
# مسح ذاكرة التخزين المؤقت لـ npm
npm cache clean --force

# حذف node_modules وإعادة التثبيت
rm -rf node_modules package-lock.json
npm install
```

---

## 🎯 Next Steps

After completing this step, you should have:
- ✅ A working Laravel project named `teaching-system`
- ✅ Laravel Breeze authentication installed
- ✅ Frontend assets building correctly
- ✅ Development server running

**الخطوات التالية**

بعد إكمال هذه الخطوة، يجب أن يكون لديك:
- ✅ مشروع Laravel يعمل باسم `teaching-system`
- ✅ تم تثبيت مصادقة Laravel Breeze
- ✅ بناء أصول الواجهة الأمامية بشكل صحيح
- ✅ خادم التطوير يعمل

**Next Step:** [Step 2: Bootstrap Integration](02_bootstrap_integration.md)

**الخطوة التالية:** [الخطوة 2: تكامل Bootstrap](02_bootstrap_integration.md)

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits#laravel-breeze)
- [Node.js Documentation](https://nodejs.org/docs/)
- [Composer Documentation](https://getcomposer.org/doc/)

**موارد إضافية**
- [توثيق Laravel](https://laravel.com/docs)
- [توثيق Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
- [توثيق Node.js](https://nodejs.org/docs/)
- [توثيق Composer](https://getcomposer.org/doc/) 