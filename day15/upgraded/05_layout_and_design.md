# Step 5: Layout and Design

## 🎨 Create Layout and Check Design

### **5.1 Main Layout File**

Create `resources/views/layouts/app.blade.php`:

```blade
<!DOCTYPE html>
<html>
<head>
  <!-- @yield('title', 'Laravel App') - Placeholder for page title, default is 'Laravel App' -->
  <title>@yield('title', 'Laravel App')</title>
  
  <!-- @vite - Loads compiled CSS and JavaScript files -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <!-- @include - Includes the navbar partial file -->
  @include('layouts.navbar')
  
  <!-- Main content area -->
  <main class="py-4">
    <!-- @yield('content') - Placeholder for main page content -->
    @yield('content')
  </main>
</body>
</html>
```

#### **🔍 Blade Layout Directives Explained:**

- **`@yield('title', 'Laravel App')`**: 
  - Creates a placeholder for page title
  - If no title is provided, uses 'Laravel App' as default
  - Child pages can set title with `@section('title', 'My Page')`

- **`@vite(['resources/css/app.css', 'resources/js/app.js'])`**: 
  - Loads compiled CSS and JavaScript files
  - Vite handles asset compilation and optimization

- **`@include('layouts.navbar')`**: 
  - Includes the navbar partial file
  - The navbar content is inserted here

- **`@yield('content')`**: 
  - Main content placeholder
  - Child pages put their content in `@section('content') ... @endsection`

### **5.2 Navbar Component**

Create `resources/views/layouts/navbar.blade.php`:

```blade
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <!-- App brand/logo -->
    <a class="navbar-brand" href="{{ route('home') }}">Articles App</a>
    
    <!-- Mobile menu toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Navigation menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <!-- Show these links only for logged-in users -->
          <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">My Articles</a></li>
          <li class="nav-item">
            <!-- Logout form - must be POST with CSRF protection -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <!-- Show these links only for guests (not logged in) -->
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
```

#### **🔍 Blade Directives Explained:**

- **`@auth` ... `@endauth`**: Shows content only to authenticated users
- **`@else`**: Shows content to guests (not logged in users)
- **`@csrf`**: Adds a hidden CSRF token to protect against cross-site request forgery
- **`{{ route('name') }}`**: Generates URLs for named routes
- **`method="POST"`**: Logout must be POST request for security

---

## 🎯 Make Choices for Layout of All Pages

### **5.3 Design System Overview**

#### **Color Scheme:**
- **Primary**: Bootstrap's default blue (`btn-primary`)
- **Success**: Green for create actions (`btn-success`)
- **Warning**: Orange for edit actions (`btn-warning`)
- **Danger**: Red for delete actions (`btn-danger`)
- **Dark**: Dark navbar (`navbar-dark bg-dark`)

#### **Layout Structure:**
- **Container**: Bootstrap container for responsive layout
- **Cards**: For article display and forms
- **Tables**: For listing data
- **Forms**: Bootstrap form styling
- **Buttons**: Consistent button styling

#### **Responsive Design:**
- **Mobile-first**: Bootstrap's responsive grid system
- **Navbar**: Collapsible on mobile devices
- **Tables**: Responsive table classes
- **Forms**: Responsive form controls

### **5.4 Common Page Layouts**

#### **Index Pages (List Views):**
```blade
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Page Title</h1>
        <a href="{{ route('create') }}" class="btn btn-primary">+ Add New</a>
    </div>
    
    <!-- Content here -->
</div>
@endsection
```

#### **Form Pages (Create/Edit):**
```blade
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Form Title</h2>
                </div>
                <div class="card-body">
                    <!-- Form here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

#### **Show Pages (Detail Views):**
```blade
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Item Title</h1>
        </div>
        <div class="card-body">
            <!-- Content here -->
        </div>
        <div class="card-footer">
            <!-- Actions here -->
        </div>
    </div>
</div>
@endsection
```

---

## 📝 الشرح بالعربية - Layout and Design

**التخطيط والتصميم:**
- **Layout**: القالب الأساسي للتطبيق
- **Navbar**: شريط التنقل
- **Responsive Design**: التصميم المتجاوب
- **Bootstrap Components**: مكونات Bootstrap

**المفاهيم المهمة:**
- `@extends('layouts.app')`: استخدام قالب أساسي
- `@section('content')`: تحديد محتوى الصفحة
- `@yield('content')`: مكان إدراج المحتوى
- `@include('layouts.navbar')`: إدراج ملف جزئي

---

## ✅ Checklist

- [ ] Main layout file created
- [ ] Navbar component created
- [ ] Bootstrap classes applied
- [ ] Responsive design working
- [ ] Mobile menu functional
- [ ] Color scheme consistent
- [ ] Layout structure defined
- [ ] Design system established

---

## 🚨 Common Issues & Solutions

### **Issue: Layout not extending properly**
```blade
<!-- Make sure you have proper structure -->
@extends('layouts.app')
@section('content')
    <!-- Your content here -->
@endsection
```

### **Issue: Navbar not responsive**
```html
<!-- Check if data-bs-toggle is used (Bootstrap 5) -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
```

### **Issue: Styles not loading**
```bash
# Rebuild assets
npm run build

# Check if Vite is working
npm run dev
```

---

## 🔍 Testing Layout

### **5.5 Test Layout Components**

```bash
# Start development server
php artisan serve

# Test in browser:
# 1. Check if navbar appears
# 2. Test responsive design (resize browser)
# 3. Test mobile menu (click hamburger)
# 4. Check if Bootstrap styles are applied
```

### **5.6 Test Different Screen Sizes**

- **Desktop**: Full navbar visible
- **Tablet**: Navbar should be responsive
- **Mobile**: Hamburger menu should work
- **Print**: Layout should be print-friendly

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Create Test Page** - Add a test page to verify layout
2. **Routes Configuration** - Set up your application routes
3. **Views & Layouts** - Create your application views

---

## 🎯 CRUD Pages Implementation

### **Articles Index Page**

Create `resources/views/articles/index.blade.php`:

```blade
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Create Article
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($article->body, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                By {{ $article->user->name }}
                            </small>
                            <div class="btn-group" role="group">
                                <a href="{{ route('articles.show', $article) }}" 
                                   class="btn btn-sm btn-outline-primary">View</a>
                                @can('update', $article)
                                    <a href="{{ route('articles.edit', $article) }}" 
                                       class="btn btn-sm btn-outline-secondary">Edit</a>
                                @endcan
                                @can('delete', $article)
                                    <form action="{{ route('articles.destroy', $article) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-journal-text display-1 text-muted"></i>
                    <h3 class="mt-3">No Articles Yet</h3>
                    <p class="text-muted">Be the first to create an article!</p>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">
                        Create Your First Article
                    </a>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
```

### **Article Create Page**

Create `resources/views/articles/create.blade.php`:

```blade
@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Create New Article</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Content</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" 
                                      id="body" name="body" rows="8" required>{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Articles
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Create Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

### **Article Show Page**

Create `resources/views/articles/show.blade.php`:

```blade
@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $article->title }}</h4>
                    <div class="btn-group" role="group">
                        @can('update', $article)
                            <a href="{{ route('articles.edit', $article) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        @endcan
                        @can('delete', $article)
                            <form action="{{ route('articles.destroy', $article) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this article?')">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">
                            By {{ $article->user->name }} • 
                            {{ $article->created_at->format('M d, Y') }}
                        </small>
                    </div>
                    
                    <div class="article-content">
                        {!! nl2br(e($article->body)) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

### **Article Edit Page**

Create `resources/views/articles/edit.blade.php`:

```blade
@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Edit Article</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('articles.update', $article) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $article->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Content</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" 
                                      id="body" name="body" rows="8" required>{{ old('body', $article->body) }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Update Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

---

## 🎨 Design Best Practices

### **Consistency:**
- Use consistent spacing (`mb-3`, `py-4`, etc.)
- Use consistent button styles
- Use consistent card layouts
- Use consistent form styling

### **Accessibility:**
- Use semantic HTML
- Add proper ARIA labels
- Ensure keyboard navigation
- Test with screen readers

### **Performance:**
- Optimize images
- Minimize CSS/JS
- Use CDN for assets
- Enable caching

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 