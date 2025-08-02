# Step 3: Database Configuration

## 🗄️ Environment Setup

### **3.1 Update Environment File**

Update your `.env` file:

```env
# Database name (create this database in your MySQL/phpMyAdmin)
DB_DATABASE=articles_app

# MySQL username (default is 'root' for XAMPP/WAMP)
DB_USERNAME=root

# MySQL password (empty by default for XAMPP/WAMP)
DB_PASSWORD=

# Database host (usually localhost for local development)
DB_HOST=127.0.0.1

# Database port (default MySQL port)
DB_PORT=3306
```

#### **🔍 Database Configuration Explained:**

- **`DB_DATABASE`**: The name of your MySQL database (you need to create this first in phpMyAdmin)
- **`DB_USERNAME`**: Your MySQL username (usually 'root' for local development)
- **`DB_PASSWORD`**: Your MySQL password (often empty for local setups)
- **`DB_HOST`**: Database server address (127.0.0.1 for localhost)
- **`DB_PORT`**: Database port (3306 is default for MySQL)
- **Important**: Make sure your MySQL server is running and the database exists!

### **3.2 Create Database**

#### **Using phpMyAdmin:**
1. Open phpMyAdmin in your browser
2. Click "New" or "Create database"
3. Enter database name: `articles_app`
4. Click "Create"

#### **Using MySQL Command Line:**
```sql
CREATE DATABASE articles_app;
```

### **3.3 Run Migrations**

```bash
# Create database tables based on migration files
php artisan migrate
```

#### **🔍 What Migrations Do:**

- **Migrations** are like version control for your database structure
- **`php artisan migrate`** creates all the tables defined in your migration files
- This will create the `users` table (from Breeze) and any other tables you define
- If you get errors, make sure your database exists and credentials are correct

---

## 📝 الشرح بالعربية - Database Configuration

**إعداد قاعدة البيانات:**
- **ملف .env**: يحتوي على إعدادات قاعدة البيانات
- **إنشاء قاعدة البيانات**: يجب إنشاء قاعدة بيانات في phpMyAdmin أولاً
- **تشغيل الكود المسئول عن انشاء قاعدة البيانات migration**: إنشاء الجداول في قاعدة البيانات

**الإعدادات المهمة:**
- `DB_DATABASE`: اسم قاعدة البيانات
- `DB_USERNAME`: اسم المستخدم (عادة root)
- `DB_PASSWORD`: كلمة المرور (فارغة في التطوير المحلي)
- `php artisan migrate`: إنشاء الجداول

---

## 🔧 Important Files Check

### **3.4 Verify Configuration Files**

#### **Check `.env` file exists:**
```bash
# Check if .env file exists
ls -la .env

# If .env doesn't exist, copy from .env.example
cp .env.example .env
```

#### **Check database connection:**
```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo()
>>> exit
```

#### **Check if migrations ran successfully:**
```bash
# Check migration status
php artisan migrate:status

# If needed, rollback and migrate again
php artisan migrate:rollback
php artisan migrate
```

### **3.5 Verify Database Tables**

After running migrations, you should have these tables:

```sql
-- Check tables in your database
SHOW TABLES;

-- Expected tables:
-- migrations
-- users
-- password_reset_tokens
-- failed_jobs
-- personal_access_tokens
```

---

## 🚨 Common Database Issues

### **Issue: Database connection failed**
```bash
# Check if MySQL is running
sudo systemctl status mysql

# Start MySQL if not running
sudo systemctl start mysql

# Check database credentials
php artisan tinker
>>> DB::connection()->getPdo()
```

### **Issue: Database doesn't exist**
```sql
-- Create database
CREATE DATABASE articles_app;
```

### **Issue: Permission denied**
```bash
# Fix MySQL permissions
sudo mysql -u root -p
GRANT ALL PRIVILEGES ON articles_app.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### **Issue: Migration errors**
```bash
# Clear cache and try again
php artisan config:clear
php artisan cache:clear
php artisan migrate:fresh
```

---

## ✅ Checklist

- [ ] `.env` file configured correctly
- [ ] Database created in MySQL/phpMyAdmin
- [ ] Database credentials are correct
- [ ] MySQL server is running
- [ ] Migrations run successfully
- [ ] Database tables created
- [ ] Connection test successful

---

## 🔍 Testing Database Connection

### **3.6 Test Connection with Tinker**

```bash
# Open Laravel Tinker
php artisan tinker

# Test database connection
>>> DB::connection()->getPdo()

# Check if users table exists
>>> Schema::hasTable('users')

# Check table structure
>>> Schema::getColumnListing('users')

# Exit tinker
>>> exit
```

### **3.8 Advanced Database Commands**

#### **🔍 Database Inspection Commands:**

```php
// Import required facades
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// List all databases in MySQL
DB::select("SHOW DATABASES");

// Get collection of database names
$databases = collect(DB::select("SHOW DATABASES"))->pluck('Database');

// Check if specific database exists
$databases->contains('articles_app'); // Returns true or false

// Check if specific table exists
Schema::hasTable('articles'); // Returns true if table exists

// List all tables in current database
DB::select("SHOW TABLES");

// Alternative way to list tables using Doctrine
Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
```

#### **🔍 Command Explanations:**

- **`DB::select("SHOW DATABASES")`**: Executes raw SQL to list all databases
- **`collect(DB::select("SHOW DATABASES"))->pluck('Database')`**: Converts result to collection and extracts database names
- **`$databases->contains('articles_app')`**: Checks if specific database exists in the list
- **`Schema::hasTable('articles')`**: Laravel's built-in method to check table existence
- **`DB::select("SHOW TABLES")`**: Lists all tables in current database
- **`Schema::getConnection()->getDoctrineSchemaManager()->listTableNames()`**: Uses Doctrine to get table names

#### **🔍 Usage Examples:**

```php
// In Tinker or Controller
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Check available databases
$databases = collect(DB::select("SHOW DATABASES"))->pluck('Database');
dd($databases); // Display all databases

// Check if our database exists
if ($databases->contains('articles_app')) {
    echo "Database exists!";
} else {
    echo "Database not found!";
}

// Check if our table exists
if (Schema::hasTable('articles')) {
    echo "Articles table exists!";
} else {
    echo "Articles table not found!";
}

// List all tables
$tables = DB::select("SHOW TABLES");
dd($tables); // Display all tables
```

### **3.7 Verify Migration Files**

Check that these migration files exist:

```bash
# List migration files
ls database/migrations/

# Expected files:
# 2014_10_12_000000_create_users_table.php
# 2014_10_12_100000_create_password_reset_tokens_table.php
# 2019_08_19_000000_create_failed_jobs_table.php
# 2019_12_14_000001_create_personal_access_tokens_table.php
```

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Model & Controller Creation** - Create your data models
2. **Routes Configuration** - Set up your application routes
3. **Views & Layouts** - Create your application views

---

## 🛠️ Additional Database Commands

### **Useful Artisan Commands:**

```bash
# Check migration status
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Rollback and migrate again
php artisan migrate:refresh

# Drop all tables and migrate again
php artisan migrate:fresh

# Seed database after migration
php artisan migrate:fresh --seed
```

### **Database Seeding (Optional):**

```bash
# Create a seeder
php artisan make:seeder DatabaseSeeder

# Run seeders
php artisan db:seed

# Run migrations and seeders together
php artisan migrate:fresh --seed
```

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 