# 🗄️ Step 3: Database Configuration - Teaching System

## 📋 Overview

This step covers configuring the database connection, creating the database, and setting up the environment for the Teaching System with proper database credentials.

**الخطوة الثالثة: تكوين قاعدة البيانات - نظام التدريس**

**نظرة عامة**
تغطي هذه الخطوة تكوين اتصال قاعدة البيانات، إنشاء قاعدة البيانات، وإعداد البيئة لنظام التدريس مع بيانات اعتماد قاعدة البيانات المناسبة.

---

## 🎯 What You'll Learn

- Configure database connection in .env file
- Create database for Teaching System
- Run initial migrations
- Verify database connection
- Test database connectivity

**ما ستتعلمه**
- تكوين اتصال قاعدة البيانات في ملف .env
- إنشاء قاعدة بيانات لنظام التدريس
- تشغيل الترحيلات الأولية
- التحقق من اتصال قاعدة البيانات
- اختبار اتصالية قاعدة البيانات

---

## 📝 Step-by-Step Instructions

### 1. Configure .env File

```env
# .env file configuration for Teaching System
APP_NAME="Teaching System"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teaching_system
DB_USERNAME=root
DB_PASSWORD=

# For XAMPP (common setup)
# DB_USERNAME=root
# DB_PASSWORD=

# For other setups, adjust as needed
# DB_USERNAME=your_username
# DB_PASSWORD=your_password
```

**Configure .env File - تكوين ملف .env**
```env
# تكوين ملف .env لنظام التدريس
APP_NAME="Teaching System"
APP_ENV=local
APP_KEY=base64:your-generated-key
APP_DEBUG=true
APP_URL=http://localhost:8000

# تكوين قاعدة البيانات
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=teaching_system
DB_USERNAME=root
DB_PASSWORD=

# لـ XAMPP (إعداد شائع)
# DB_USERNAME=root
# DB_PASSWORD=

# لإعدادات أخرى، اضبط حسب الحاجة
# DB_USERNAME=your_username
# DB_PASSWORD=your_password
```

### 2. Create Database

**Option A: Using phpMyAdmin (GUI)**
1. Open phpMyAdmin in your browser
2. Click "New" or "Create Database"
3. Enter database name: `teaching_system`
4. Select collation: `utf8mb4_unicode_ci`
5. Click "Create"

**Option B: Using MySQL Command Line**
```bash
# Connect to MySQL
mysql -u root -p

# Create database
CREATE DATABASE teaching_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Verify database creation
SHOW DATABASES;

# Exit MySQL
EXIT;
```

**Option C: Using Laravel Tinker**
```bash
# Start Laravel Tinker
php artisan tinker

# Create database (if you have permissions)
DB::statement('CREATE DATABASE IF NOT EXISTS teaching_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');

# Exit Tinker
exit
```

**Create Database - إنشاء قاعدة البيانات**

**الخيار أ: استخدام phpMyAdmin (واجهة رسومية)**
1. افتح phpMyAdmin في المتصفح
2. انقر على "New" أو "Create Database"
3. أدخل اسم قاعدة البيانات: `teaching_system`
4. اختر collation: `utf8mb4_unicode_ci`
5. انقر على "Create"

**الخيار ب: استخدام سطر أوامر MySQL**
```bash
# الاتصال بـ MySQL
mysql -u root -p

# إنشاء قاعدة البيانات
CREATE DATABASE teaching_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# التحقق من إنشاء قاعدة البيانات
SHOW DATABASES;

# الخروج من MySQL
EXIT;
```

**الخيار ج: استخدام Laravel Tinker**
```bash
# بدء Laravel Tinker
php artisan tinker

# إنشاء قاعدة البيانات (إذا كان لديك أذونات)
DB::statement('CREATE DATABASE IF NOT EXISTS teaching_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');

# الخروج من Tinker
exit
```

### 3. Run Initial Migrations

```bash
# Run all migrations
php artisan migrate

# Check migration status
php artisan migrate:status

# If you need to rollback and re-run
php artisan migrate:rollback
php artisan migrate
```

**Run Initial Migrations - تشغيل الترحيلات الأولية**
```bash
# تشغيل جميع الترحيلات
php artisan migrate

# فحص حالة الترحيلات
php artisan migrate:status

# إذا كنت بحاجة إلى التراجع وإعادة التشغيل
php artisan migrate:rollback
php artisan migrate
```

### 4. Verify Database Connection

```bash
# Test database connection using Tinker
php artisan tinker

# Test connection
DB::connection()->getPdo();

# Check if tables exist
DB::select('SHOW TABLES');

# Exit Tinker
exit
```

**Verify Database Connection - التحقق من اتصال قاعدة البيانات**
```bash
# اختبار اتصال قاعدة البيانات باستخدام Tinker
php artisan tinker

# اختبار الاتصال
DB::connection()->getPdo();

# فحص وجود الجداول
DB::select('SHOW TABLES');

# الخروج من Tinker
exit
```

### **3.8 Advanced Database Commands - أوامر قاعدة البيانات المتقدمة**

#### **🔍 Database Inspection Commands - أوامر فحص قاعدة البيانات:**

```php
// Import required facades - استيراد الفاساد المطلوبة
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// List all databases in MySQL - قائمة بجميع قواعد البيانات في MySQL
DB::select("SHOW DATABASES");

// Get collection of database names - الحصول على مجموعة أسماء قواعد البيانات
$databases = collect(DB::select("SHOW DATABASES"))->pluck('Database');

// Check if specific database exists - التحقق من وجود قاعدة بيانات محددة
$databases->contains('teaching_system'); // Returns true or false - ترجع true أو false

// Check if specific table exists - التحقق من وجود جدول محدد
Schema::hasTable('students'); // Returns true if table exists - ترجع true لو الجدول موجود

// List all tables in current database - قائمة بجميع الجداول في قاعدة البيانات الحالية
DB::select("SHOW TABLES");

// Alternative way to list tables using Doctrine - طريقة بديلة لسرد الجداول باستخدام Doctrine
Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
```

#### **🔍 Command Explanations - شرح الأوامر:**

- **`DB::select("SHOW DATABASES")`**: Executes raw SQL to list all databases - تنفيذ SQL خام لعرض جميع قواعد البيانات
- **`collect(DB::select("SHOW DATABASES"))->pluck('Database')`**: Converts result to collection and extracts database names - تحويل النتيجة إلى مجموعة واستخراج أسماء قواعد البيانات
- **`$databases->contains('teaching_system')`**: Checks if specific database exists in the list - التحقق من وجود قاعدة بيانات محددة في القائمة
- **`Schema::hasTable('students')`**: Laravel's built-in method to check table existence - طريقة Laravel المدمجة للتحقق من وجود الجدول
- **`DB::select("SHOW TABLES")`**: Lists all tables in current database - قائمة بجميع الجداول في قاعدة البيانات الحالية
- **`Schema::getConnection()->getDoctrineSchemaManager()->listTableNames()`**: Uses Doctrine to get table names - استخدام Doctrine للحصول على أسماء الجداول

#### **🔍 Usage Examples - أمثلة الاستخدام:**

```php
// In Tinker or Controller - في Tinker أو Controller
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Check available databases - التحقق من قواعد البيانات المتاحة
$databases = collect(DB::select("SHOW DATABASES"))->pluck('Database');
dd($databases); // Display all databases - عرض جميع قواعد البيانات

// Check if our database exists - التحقق من وجود قاعدة البيانات الخاصة بنا
if ($databases->contains('teaching_system')) {
    echo "Database exists! - قاعدة البيانات موجودة!";
} else {
    echo "Database not found! - قاعدة البيانات غير موجودة!";
}

// Check if our table exists - التحقق من وجود الجدول الخاص بنا
if (Schema::hasTable('students')) {
    echo "Students table exists! - جدول الطلاب موجود!";
} else {
    echo "Students table not found! - جدول الطلاب غير موجود!";
}

// List all tables - قائمة بجميع الجداول
$tables = DB::select("SHOW TABLES");
dd($tables); // Display all tables - عرض جميع الجداول
```

### 5. Check Important Configuration Files

**config/database.php** - Verify database configuration
**config/app.php** - Check application settings
**bootstrap/cache/config.php** - Clear cache if needed

```bash
# Clear configuration cache
php artisan config:clear

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

**Check Important Configuration Files - فحص ملفات التكوين المهمة**

**config/database.php** - التحقق من تكوين قاعدة البيانات
**config/app.php** - فحص إعدادات التطبيق
**bootstrap/cache/config.php** - مسح الذاكرة المؤقتة إذا لزم الأمر

```bash
# مسح ذاكرة التخزين المؤقت للتكوين
php artisan config:clear

# مسح جميع الذاكرات المؤقتة
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## ✅ Checklist

- [ ] .env file configured with correct database settings
- [ ] Database `teaching_system` created
- [ ] Database connection tested successfully
- [ ] Initial migrations run without errors
- [ ] Configuration cache cleared
- [ ] All caches cleared
- [ ] Database tables created (users, password_reset_tokens, etc.)

**قائمة التحقق**
- [ ] تم تكوين ملف .env مع إعدادات قاعدة البيانات الصحيحة
- [ ] تم إنشاء قاعدة البيانات `teaching_system`
- [ ] تم اختبار اتصال قاعدة البيانات بنجاح
- [ ] تم تشغيل الترحيلات الأولية بدون أخطاء
- [ ] تم مسح ذاكرة التخزين المؤقت للتكوين
- [ ] تم مسح جميع الذاكرات المؤقتة
- [ ] تم إنشاء جداول قاعدة البيانات (users, password_reset_tokens, إلخ)

---

## 🔧 Common Issues & Solutions

### Issue: Database connection failed
**Solution:**
```bash
# Check if MySQL is running
sudo systemctl status mysql

# Start MySQL if not running
sudo systemctl start mysql

# Check credentials in .env
# Make sure DB_DATABASE, DB_USERNAME, DB_PASSWORD are correct
```

### Issue: Access denied for user
**Solution:**
```bash
# Reset MySQL root password
sudo mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
FLUSH PRIVILEGES;
EXIT;
```

### Issue: Database doesn't exist
**Solution:**
```bash
# Create database manually
mysql -u root -p
CREATE DATABASE teaching_system;
EXIT;
```

### Issue: Migration errors
**Solution:**
```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear

# Reset migrations
php artisan migrate:reset
php artisan migrate
```

**المشاكل الشائعة والحلول**

### المشكلة: فشل اتصال قاعدة البيانات
**الحل:**
```bash
# فحص ما إذا كان MySQL يعمل
sudo systemctl status mysql

# بدء MySQL إذا لم يكن يعمل
sudo systemctl start mysql

# فحص بيانات الاعتماد في .env
# تأكد من صحة DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### المشكلة: رفض الوصول للمستخدم
**الحل:**
```bash
# إعادة تعيين كلمة مرور MySQL root
sudo mysql -u root
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
FLUSH PRIVILEGES;
EXIT;
```

### المشكلة: قاعدة البيانات غير موجودة
**الحل:**
```bash
# إنشاء قاعدة البيانات يدوياً
mysql -u root -p
CREATE DATABASE teaching_system;
EXIT;
```

### المشكلة: أخطاء الترحيل
**الحل:**
```bash
# مسح جميع الذاكرات المؤقتة
php artisan config:clear
php artisan cache:clear

# إعادة تعيين الترحيلات
php artisan migrate:reset
php artisan migrate
```

---

## 🎯 Next Steps

After completing this step, you should have:
- ✅ Database `teaching_system` created and configured
- ✅ Database connection working properly
- ✅ Initial Laravel tables created (users, password_reset_tokens, etc.)
- ✅ Environment properly configured

**الخطوات التالية**

بعد إكمال هذه الخطوة، يجب أن يكون لديك:
- ✅ تم إنشاء وتكوين قاعدة البيانات `teaching_system`
- ✅ اتصال قاعدة البيانات يعمل بشكل صحيح
- ✅ تم إنشاء جداول Laravel الأولية (users, password_reset_tokens, إلخ)
- ✅ تم تكوين البيئة بشكل صحيح

**Next Step:** [Step 4: Models and Controllers](04_models_and_controllers.md)

**الخطوة التالية:** [الخطوة 4: النماذج والتحكم](04_models_and_controllers.md)

---

## 📚 Additional Resources

- [Laravel Database Documentation](https://laravel.com/docs/database)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [phpMyAdmin Documentation](https://docs.phpmyadmin.net/)
- [Laravel Migrations](https://laravel.com/docs/migrations)

**موارد إضافية**
- [توثيق قاعدة بيانات Laravel](https://laravel.com/docs/database)
- [توثيق MySQL](https://dev.mysql.com/doc/)
- [توثيق phpMyAdmin](https://docs.phpmyadmin.net/)
- [ترحيلات Laravel](https://laravel.com/docs/migrations) 