## 🎓 Presentation: Build a Laravel Training System (with Bootstrap)

---

### **Slide 1: العنوان**

🔧 **Laravel + Bootstrap: Build a Training System Step by Step**

- بناء نظام تدريب متكامل باستخدام Laravel
- التصميم باستخدام Bootstrap
- تسجيل دخول وتسجيل مستخدم + CRUD كامل للطلاب والمدرسين والكورسات والتسجيلات

---

### **Slide 2: فكرة المشروع**

🧠 **نظام إدارة التدريب:**

- تسجيل دخول/تسجيل جديد للمستخدمين (طالب أو مدرس)
- الطلاب يمكنهم استعراض الكورسات وعمل Enroll
- المدرسون يمكنهم إنشاء كورسات

---

### **Slide 3: إنشاء Laravel Project + Breeze**

```bash
composer create-project laravel/laravel training_system
cd training_system
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

---

### **Slide 4: إعداد قاعدة البيانات**

🛠️ ملف `.env`:

```env
DB_DATABASE=training_system
DB_USERNAME=root
DB_PASSWORD=
```

ثم:

```bash
php artisan migrate
```

---

### **Slide 5: إنشاء Models + Controllers + Migrations**

```bash
php artisan make:model Student -mc
php artisan make:model Course -mc
php artisan make:model Teacher -mc
php artisan make:model Enrollment -mc
```

---

### **Slide 6: تعديل Migration وربط الجداول**

```php
// database/migrations/create_enrollments_table.php
$table->foreignId('student_id')->constrained()->onDelete('cascade');
$table->foreignId('course_id')->constrained()->onDelete('cascade');
$table->foreignId('teacher_id')->constrained()->onDelete('cascade');
```

ثم:

```bash
php artisan migrate
```

---

### **Slide 7: تعريف العلاقات بين Models**

```php
// Student.php
public function enrollments() {
    return $this->hasMany(Enrollment::class);
}

// Course.php
public function enrollments() {
    return $this->hasMany(Enrollment::class);
}

// Teacher.php
public function courses() {
    return $this->hasMany(Course::class);
}

// Enrollment.php
public function student() {
    return $this->belongsTo(Student::class);
}
public function course() {
    return $this->belongsTo(Course::class);
}
public function teacher() {
    return $this->belongsTo(Teacher::class);
}
```

---

### **Slide 8: تركيب Bootstrap**

```bash
npm install bootstrap
```

`resources/css/app.css`:

```css
@import 'bootstrap/dist/css/bootstrap.min.css';
```

`resources/js/app.js`:

```js
import 'bootstrap';
```

ثم:

```bash
npm run build
```

---

### **Slide 9: صفحات الطلاب (Students CRUD)**

#### `students.index`:

```blade
@extends('layouts.app')
@section('content')
<div class="container">
  <h1>All Students</h1>
  <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">+ Add Student</a>
  <table class="table">
    <thead>
      <tr><th>ID</th><th>Name</th><th>Email</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
        <tr>
          <td>{{ $student->id }}</td>
          <td>{{ $student->name }}</td>
          <td>{{ $student->email }}</td>
          <td>
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
```

#### `students.create`:

```blade
@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Add Student</h1>
  <form method="POST" action="{{ route('students.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
  </form>
</div>
@endsection
```

#### `students.edit`:

```blade
@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Edit Student</h1>
  <form method="POST" action="{{ route('students.update', $student) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
@endsection
```

---

### **Slide 10: استخدم نفس الشكل مع باقي الجداول**

- يمكنك تكرار نفس الهيكل لكل من `courses`, `teachers`, و `enrollments`
- فقط غيّر الحقول لتتناسب مع كل جدول
- نفس شكل الجدول والعرض والتعديل والإضافة

---

### **Slide 11: الخطوة التالية؟**

🚀 بعد الانتهاء من CRUD الأساسي:

- إضافة صلاحيات Roles (Teacher, Student)
- عرض الكورسات فقط للطلاب
- عرض الطلاب المسجلين فقط للمدرسين
- تصميم صفحة Dashboard منفصلة لكل نوع مستخدم

