## 🎓 Presentation: Build a Laravel Articles App (with Bootstrap)

---

### **Slide 1: العنوان**

🔧 **Laravel + Bootstrap: Build an Articles App Step by Step**

- بناء نظام مقالات متكامل باستخدام Laravel
- التصميم باستخدام Bootstrap
- تسجيل دخول وتسجيل مستخدم + CRUD كامل

---

### **Slide 2: فكرة المشروع**

🧠 **نظام إدارة مقالات:**

- صفحة رئيسية تعرض المقالات
- تسجيل دخول/تسجيل جديد للمستخدمين
- يمكن لكل مستخدم إضافة/تعديل/حذف مقال خاص به

---

### **Slide 3: تنصيب Laravel + Breeze**

```bash
composer global require laravel/installer
composer create-project laravel/laravel articles-app
cd articles-app
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

---

### **Slide 4: إعداد قاعدة البيانات**

🛠️ في ملف `.env`:

```env
DB_DATABASE=articles_app
DB_USERNAME=root
DB_PASSWORD=
```

ثم:

```bash
php artisan migrate
```

---

### **Slide 5: تركيب Bootstrap**

🔧 نضيف Bootstrap عبر Vite:

```bash
npm install bootstrap
```

ثم في `resources/css/app.css`:

```css
@import 'bootstrap/dist/css/bootstrap.min.css';
```

وفي `resources/js/app.js`:

```js
import 'bootstrap';
```

ثم نشغّل:

```bash
npm run build
```

✅ لاحظ: استخدمنا `npm run build` بدل `npm run dev` عشان نجهز الملفات بشكل نهائي للإنتاج.

---

### **Slide 6: تركيب Navbar بـ Bootstrap**

```blade
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Articles App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">My Articles</a></li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
```

---

### **Slide 7: إنشاء Model + Controller للمقالات**

```bash
php artisan make:model Article -m
php artisan make:controller ArticleController --resource
```

في `create_articles_table.php`:

```php
$table->string('title');
$table->text('body');
$table->foreignId('user_id')->constrained()->onDelete('cascade');
```

ثم:

```bash
php artisan migrate
```

---

### **Slide 10: العرض باستخدام Blade + Bootstrap**

---


### **Slide 11: Layouts - إعادة استخدام الشكل العام**

```blade
<!DOCTYPE html>
<html>
<head>
  <title>@yield('title', 'Laravel App')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  @include('layouts.navbar')
  <main class="py-4">
    @yield('content')
  </main>
</body>
</html>
```
---

### 🏠 2. **إنشاء صفحة welcome.blade.php باستخدام layout**

```blade
@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="mb-4">Welcome to the Articles App</h1>
    <p class="lead">Laravel + Bootstrap simple app to manage articles.</p>
</div>
@endsection
```

> تأكد إن `layouts.app` موجود ويحتوي على `@vite()` و `@yield('content')`
---

```blade
@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">My Articles</h1>
  <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">+ New Article</a>
  @foreach ($articles as $article)
    <div class="card mb-3">
      <div class="card-body">
        <h5>{{ $article->title }}</h5>
        <p>{{ $article->body }}</p>
        <a href="{{ route('articles.edit', $article) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Delete</button>
        </form>
      </div>
    </div>
  @endforeach
</div>
@endsection
```
---


---

### 🧭 8. **تصميم صفحة Dashboard**

`resources/views/dashboard.blade.php`

```blade
@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="mb-4">Dashboard</h1>
    <p class="lead">Welcome, {{ Auth::user()->name }}!</p>
    <a href="{{ route('articles.index') }}" class="btn btn-primary">Manage My Articles</a>
</div>
@endsection
```

---

### 🔐 9. **تصميم صفحة Login**

`resources/views/auth/login.blade.php`

```blade
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

---

### 🌟 10. **تصميم صفحة Register**

`resources/views/auth/register.blade.php`

```blade
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Register</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Create Account</button>
            </form>
        </div>
    </div>
</div>
@endsection
```

---

### 2. استدعاء الـ Model داخل الكنترولر:

```php
use App\Models\Article;
```

3. في `ArticleController` استخدم `Article::` بدلاً من كتابة `App\Http\Controllers\Article` عن طريق كتابة:

```php
use App\Models\Article;
```

فوق الكلاس مباشرة.

---

### **Slide 8: إعداد الـ Routes**

```php
use App\Http\Controllers\ArticleController;

Route::get('/', fn () => view('welcome'));
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class);
    // Route::get('/articles', [ArticleController::class, 'index']);
    // Route::get('/articles/create', [ArticleController::class, 'create']);
    // Route::post('/articles', [ArticleController::class, 'store']);
    // Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update']);
    // Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
});
```
---

### 🧹 1. **Route التعريفات**

```php
use App\Http\Controllers\ArticleController;

// عرض المقالات للجميع
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// عمليات CRUD محمية للمسجلين فقط
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
    // Route::get('/articles', [ArticleController::class, 'index']);
    // Route::get('/articles/create', [ArticleController::class, 'create']);
    // Route::post('/articles', [ArticleController::class, 'store']);
    // Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update']);
    // Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
});
```

---

### **Slide 9: الفرق بين تعريف Resource و يدوي**

| الطريقة  | الشرح                                                                   |
| -------- | ----------------------------------------------------------------------- |
| resource | Laravel يجهز كل الـ routes: index, create, store, edit, update, destroy |
| يدوي     | تكتب كل Route بنفسك وتحكم كامل                                          |

---

### **Slide 12: فوائدة Layouts**

✅ نوفر وقت التكرار\
✅ نضمن تناسق الموقع\
✅ نقدر نعدل شكل الموقع بالكامل من مكان واحد

---

### **Slide 13: التسجيل وتسجيل الدخول**

Laravel Breeze بيجهز الصفحات التالية تلقائيًا:

- `/login`
- `/register`
- `/dashboard`

كلها جاهزة وبتشتغل تلقائيًا بمجرد التنصيب + migration.

---

### **Slide 14: بعد بناء ال CRUD**

🛠️ الآن عندنا:

- تسجيل دخول كامل
- صفحة عرض كل المقالات
- إنشاء وتعديل وحذف المقالات
- تصميم محترم بـ Bootstrap

---

### **Slide 15: الخطوة الجاية؟**

🚀 ممكن نضيف:

- رفع صور للمقالات
- علاقات متقدمة (مثلاً Tags, Comments)
- صلاحيات Admin
- البحث والتصنيف

