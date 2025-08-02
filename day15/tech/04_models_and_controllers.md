# 🏗️ Step 4: Models and Controllers - Teaching System

## 📋 Overview

This step covers creating the core models (Student, Course, Teacher, Enrollment) with their relationships and controllers for the Teaching System. The relationships are:
- `students.id = enrollments.student_id`
- `courses.id = enrollments.course_id`
- `teachers.id = enrollments.teacher_id`

**الخطوة الرابعة: النماذج والتحكم - نظام التدريس**

**نظرة عامة**
تغطي هذه الخطوة إنشاء النماذج الأساسية (Student, Course, Teacher, Enrollment) مع علاقاتها والتحكم لنظام التدريس. العلاقات هي:
- `students.id = enrollments.student_id`
- `courses.id = enrollments.course_id`
- `teachers.id = enrollments.teacher_id`

---

## 🎯 What You'll Learn

- Generate models with migrations, factories, and seeders
- Define model relationships
- Create resource controllers
- Implement CRUD methods
- Set up proper database structure

**ما ستتعلمه**
- توليد النماذج مع الترحيلات والمصانع والبذور
- تعريف علاقات النماذج
- إنشاء تحكم الموارد
- تنفيذ طرق CRUD
- إعداد هيكل قاعدة البيانات المناسب

---

## 📝 Step-by-Step Instructions

### 1. Generate Models with Migrations

```bash
# Generate Student model with migration, factory, and seeder
php artisan make:model Student -mfs

# Generate Course model with migration, factory, and seeder
php artisan make:model Course -mfs

# Generate Teacher model with migration, factory, and seeder
php artisan make:model Teacher -mfs

# Generate Enrollment model with migration, factory, and seeder
php artisan make:model Enrollment -mfs
```

**Generate Models with Migrations - توليد النماذج مع الترحيلات**
```bash
# توليد نموذج Student مع الترحيل والمصنع والبذور
php artisan make:model Student -mfs

# توليد نموذج Course مع الترحيل والمصنع والبذور
php artisan make:model Course -mfs

# توليد نموذج Teacher مع الترحيل والمصنع والبذور
php artisan make:model Teacher -mfs

# توليد نموذج Enrollment مع الترحيل والمصنع والبذور
php artisan make:model Enrollment -mfs
```

### 2. Configure Student Migration

```php
// database/migrations/xxxx_xx_xx_create_students_table.php
public function up(): void
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('address')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->string('student_id')->unique(); // Student ID number
        $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
        $table->timestamps();
    });
}
```

**Configure Student Migration - تكوين ترحيل Student**
```php
// database/migrations/xxxx_xx_xx_create_students_table.php
public function up(): void
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('address')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->string('student_id')->unique(); // رقم هوية الطالب
        $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
        $table->timestamps();
    });
}
```

### 3. Configure Course Migration

```php
// database/migrations/xxxx_xx_xx_create_courses_table.php
public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('code')->unique(); // Course code
        $table->integer('credits')->default(3);
        $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->decimal('price', 8, 2)->nullable();
        $table->integer('duration_hours')->nullable();
        $table->timestamps();
    });
}
```

**Configure Course Migration - تكوين ترحيل Course**
```php
// database/migrations/xxxx_xx_xx_create_courses_table.php
public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('code')->unique(); // رمز المقرر
        $table->integer('credits')->default(3);
        $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->decimal('price', 8, 2)->nullable();
        $table->integer('duration_hours')->nullable();
        $table->timestamps();
    });
}
```

### 4. Configure Teacher Migration

```php
// database/migrations/xxxx_xx_xx_create_teachers_table.php
public function up(): void
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->text('bio')->nullable();
        $table->string('specialization')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->string('teacher_id')->unique(); // Teacher ID number
        $table->timestamps();
    });
}
```

**Configure Teacher Migration - تكوين ترحيل Teacher**
```php
// database/migrations/xxxx_xx_xx_create_teachers_table.php
public function up(): void
{
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->text('bio')->nullable();
        $table->string('specialization')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->string('teacher_id')->unique(); // رقم هوية المعلم
        $table->timestamps();
    });
}
```

### 5. Configure Enrollment Migration

```php
// database/migrations/xxxx_xx_xx_create_enrollments_table.php
public function up(): void
{
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
        $table->date('enrollment_date');
        $table->date('completion_date')->nullable();
        $table->enum('status', ['enrolled', 'in_progress', 'completed', 'dropped'])->default('enrolled');
        $table->decimal('grade', 5, 2)->nullable(); // Grade out of 100
        $table->text('notes')->nullable();
        $table->timestamps();
        
        // Ensure unique enrollment per student per course
        $table->unique(['student_id', 'course_id']);
    });
}
```

**Configure Enrollment Migration - تكوين ترحيل Enrollment**
```php
// database/migrations/xxxx_xx_xx_create_enrollments_table.php
public function up(): void
{
    Schema::create('enrollments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
        $table->date('enrollment_date');
        $table->date('completion_date')->nullable();
        $table->enum('status', ['enrolled', 'in_progress', 'completed', 'dropped'])->default('enrolled');
        $table->decimal('grade', 5, 2)->nullable(); // الدرجة من 100
        $table->text('notes')->nullable();
        $table->timestamps();
        
        // ضمان التسجيل الفريد لكل طالب في كل مقرر
        $table->unique(['student_id', 'course_id']);
    });
}
```

### 6. Configure Models with Relationships

**Student Model:**
```php
// app/Models/Student.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'gender',
        'student_id',
        'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }
}
```

**Course Model:**
```php
// app/Models/Course.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'credits',
        'level',
        'status',
        'price',
        'duration_hours'
    ];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }
}
```

**Teacher Model:**
```php
// app/Models/Teacher.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'specialization',
        'gender',
        'status',
        'teacher_id'
    ];

    // Relationships
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withPivot('grade', 'status', 'enrollment_date')
                    ->withTimestamps();
    }
}
```

**Enrollment Model:**
```php
// app/Models/Enrollment.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'teacher_id',
        'enrollment_date',
        'completion_date',
        'status',
        'grade',
        'notes'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'completion_date' => 'date',
        'grade' => 'decimal:2',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
```

### 7. Generate Resource Controllers

```bash
# Generate resource controllers for all models
php artisan make:controller StudentController --resource
php artisan make:controller CourseController --resource
php artisan make:controller TeacherController --resource
php artisan make:controller EnrollmentController --resource
```

**Generate Resource Controllers - توليد تحكم الموارد**
```bash
# توليد تحكم الموارد لجميع النماذج
php artisan make:controller StudentController --resource
php artisan make:controller CourseController --resource
php artisan make:controller TeacherController --resource
php artisan make:controller EnrollmentController --resource
```

### 8. Run Migrations

```bash
# Run all migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

**Run Migrations - تشغيل الترحيلات**
```bash
# تشغيل جميع الترحيلات
php artisan migrate

# فحص حالة الترحيلات
php artisan migrate:status
```

---

## ✅ Checklist

- [ ] Student model created with migration, factory, and seeder
- [ ] Course model created with migration, factory, and seeder
- [ ] Teacher model created with migration, factory, and seeder
- [ ] Enrollment model created with migration, factory, and seeder
- [ ] All migrations configured with proper relationships
- [ ] Models configured with fillable fields and relationships
- [ ] Resource controllers generated
- [ ] Migrations run successfully
- [ ] Database tables created with proper foreign keys

**قائمة التحقق**
- [ ] تم إنشاء نموذج Student مع الترحيل والمصنع والبذور
- [ ] تم إنشاء نموذج Course مع الترحيل والمصنع والبذور
- [ ] تم إنشاء نموذج Teacher مع الترحيل والمصنع والبذور
- [ ] تم إنشاء نموذج Enrollment مع الترحيل والمصنع والبذور
- [ ] تم تكوين جميع الترحيلات مع العلاقات المناسبة
- [ ] تم تكوين النماذج مع الحقول القابلة للتعبئة والعلاقات
- [ ] تم توليد تحكم الموارد
- [ ] تم تشغيل الترحيلات بنجاح
- [ ] تم إنشاء جداول قاعدة البيانات مع المفاتيح الأجنبية المناسبة

---

## 🔧 Common Issues & Solutions

### Issue: Foreign key constraint fails
**Solution:**
```bash
# Drop all tables and re-run migrations
php artisan migrate:fresh
```

### Issue: Model relationships not working
**Solution:**
```php
// Make sure relationships are properly defined
// Check if foreign key names match
// Verify table names are correct
```

### Issue: Migration rollback fails
**Solution:**
```bash
# Reset all migrations
php artisan migrate:reset
php artisan migrate
```

**المشاكل الشائعة والحلول**

### المشكلة: فشل قيود المفتاح الأجنبي
**الحل:**
```bash
# حذف جميع الجداول وإعادة تشغيل الترحيلات
php artisan migrate:fresh
```

### المشكلة: علاقات النموذج لا تعمل
**الحل:**
```php
// تأكد من تعريف العلاقات بشكل صحيح
// تحقق من تطابق أسماء المفاتيح الأجنبية
// تحقق من صحة أسماء الجداول
```

### المشكلة: فشل التراجع عن الترحيل
**الحل:**
```bash
# إعادة تعيين جميع الترحيلات
php artisan migrate:reset
php artisan migrate
```

---

## 🎯 Next Steps

After completing this step, you should have:
- ✅ All models created with proper relationships
- ✅ Database tables created with foreign key constraints
- ✅ Resource controllers generated
- ✅ Models configured with fillable fields and relationships

**الخطوات التالية**

بعد إكمال هذه الخطوة، يجب أن يكون لديك:
- ✅ تم إنشاء جميع النماذج مع العلاقات المناسبة
- ✅ تم إنشاء جداول قاعدة البيانات مع قيود المفاتيح الأجنبية
- ✅ تم توليد تحكم الموارد
- ✅ تم تكوين النماذج مع الحقول القابلة للتعبئة والعلاقات

**Next Step:** [Step 5: Layout and Design](05_layout_and_design.md)

**الخطوة التالية:** [الخطوة 5: التخطيط والتصميم](05_layout_and_design.md)

---

## 📚 Additional Resources

- [Laravel Eloquent Relationships](https://laravel.com/docs/eloquent-relationships)
- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Resource Controllers](https://laravel.com/docs/controllers#resource-controllers)
- [Database Foreign Keys](https://laravel.com/docs/migrations#foreign-key-constraints)

**موارد إضافية**
- [علاقات Laravel Eloquent](https://laravel.com/docs/eloquent-relationships)
- [ترحيلات Laravel](https://laravel.com/docs/migrations)
- [تحكم الموارد في Laravel](https://laravel.com/docs/controllers#resource-controllers)
- [المفاتيح الأجنبية لقاعدة البيانات](https://laravel.com/docs/migrations#foreign-key-constraints) 