# 🎓 Laravel Articles App with Bootstrap - Complete CRUD Guide

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/]

---

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Installation & Setup](#installation--setup)
3. [Database Configuration](#database-configuration)
4. [Bootstrap Integration](#bootstrap-integration)
5. [Navigation Setup](#navigation-setup)
6. [Model & Controller Creation](#model--controller-creation)
7. [Routes Configuration](#routes-configuration)
8. [Views & Layouts](#views--layouts)
9. [Authentication Pages](#authentication-pages)
10. [CRUD Operations](#crud-operations)
11. [Next Steps](#next-steps)

---

## 🎯 Project Overview

### **Building a Laravel Articles App with Bootstrap**

- **Framework**: Laravel + Bootstrap
- **Features**: Complete CRUD operations for articles
- **Authentication**: User registration and login
- **Design**: Modern UI with Bootstrap components

### **Project Goals**

🧠 **Article Management System:**
- Homepage displaying all articles
- User registration and login functionality
- Users can add, edit, and delete their own articles
- Secure authentication and authorization

---

## 🚀 Installation & Setup

### **Step 1: Create Laravel Project with Breeze**

```bash
composer create-project laravel/laravel articles-app
cd articles-app
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
```

### **Step 2: Install Dependencies**

```bash
npm install
npm run build
```

---

## 🗄️ Database Configuration

### **Environment Setup**

Update your `.env` file:

```env
DB_DATABASE=articles_app
DB_USERNAME=root
DB_PASSWORD=
```

### **Run Migrations**

```bash
php artisan migrate
```

---

## 🎨 Bootstrap Integration

### **Install Bootstrap**

```bash
npm install bootstrap
```

### **Configure CSS**

In `resources/css/app.css`:

```css
@import 'bootstrap/dist/css/bootstrap.min.css';
```

### **Configure JavaScript**

In `resources/js/app.js`:

```js
import 'bootstrap';
```

### **Build Assets**

```bash
npm run build
```

> **Note**: Use `npm run build` instead of `npm run dev` to prepare production-ready files.

---

## 🧭 Navigation Setup

### **Bootstrap Navbar Implementation**

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

## 🏗️ Model & Controller Creation

### **Generate Model and Migration**

```bash
php artisan make:model Article -m
```

### **Migration Schema**

In `create_articles_table.php`:

```php
$table->string('title');
$table->text('body');
$table->foreignId('user_id')->constrained()->onDelete('cascade');
```

### **Run Migration**

```bash
php artisan migrate
```

### **Generate Controller**

```bash
php artisan make:controller ArticleController --resource
```

### **Model Configuration**

In `Article.php`:

```php
use App\Models\User;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### **Controller Setup**

In `ArticleController.php`:

```php
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $articles = Article::with('user')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $request->user()->articles()->create($data);

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Article updated!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted!');
    }
}
```

---

## 🛣️ Routes Configuration

### **Route Definitions**

```php
use App\Http\Controllers\ArticleController;

// Public routes
Route::get('/', fn () => view('welcome'));

// Protected CRUD routes
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class);
});
```

### **Resource vs Manual Routes**

| Method | Description |
|--------|-------------|
| `resource` | Laravel automatically creates all CRUD routes |
| Manual | Write each route individually for full control |

---

## 🎨 Views & Layouts

### **Main Layout**

`resources/views/layouts/app.blade.php`:

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

### **Welcome Page**

`resources/views/welcome.blade.php`:

```blade
@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="mb-4">Welcome to the Articles App</h1>
    <p class="lead">Laravel + Bootstrap simple app to manage articles.</p>
</div>
@endsection
```

### **Articles Index Page**

`resources/views/articles/index.blade.php`:

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

### **Create Article Form**

`resources/views/articles/create.blade.php`:

```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Article</h2>
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save Article</button>
    </form>
</div>
@endsection
```

### **Edit Article Form**

`resources/views/articles/edit.blade.php`:

```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Article</h2>
    <form method="POST" action="{{ route('articles.update', $article) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body', $article->body) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
@endsection
```

---

## 🔐 Authentication Pages

### **Dashboard Page**

`resources/views/dashboard.blade.php`:

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

### **Login Page**

`resources/views/auth/login.blade.php`:

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

### **Register Page**

`resources/views/auth/register.blade.php`:

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

## 🔧 CRUD Operations

### **Create Operation**

```php
public function store(Request $request) {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $request->user()->articles()->create($data);

    return redirect()->route('articles.index')->with('success', 'Article created successfully!');
}
```

### **Read Operation**

```php
public function index() {
    $articles = Article::with('user')->latest()->get();
    return view('articles.index', compact('articles'));
}
```

### **Update Operation**

```php
public function update(Request $request, Article $article) {
    $this->authorize('update', $article);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $article->update($data);

    return redirect()->route('articles.index')->with('success', 'Article updated!');
}
```

### **Delete Operation**

```php
public function destroy(Article $article) {
    $this->authorize('delete', $article);
    $article->delete();

    return redirect()->route('articles.index')->with('success', 'Article deleted!');
}
```

---

## 🚀 Next Steps

### **Advanced Features to Implement**

- **Image Upload**: Add image upload functionality for articles
- **Advanced Relationships**: Implement tags, categories, and comments
- **Admin Panel**: Create admin roles and permissions
- **Search & Filtering**: Add search functionality and article filtering
- **API Development**: Create RESTful API endpoints
- **Testing**: Implement unit and feature tests

### **Performance Optimizations**

- **Caching**: Implement Redis caching for better performance
- **Pagination**: Add pagination for large article lists
- **Lazy Loading**: Optimize image loading and relationships
- **CDN Integration**: Use CDN for static assets

---

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits#laravel-breeze)

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 