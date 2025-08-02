# Step 7: Basic CRUD Operations

## 🔧 Start Basic CRUD System Operations

### **7.1 Create Operation**

#### **Create Article Form**

Create `resources/views/articles/create.blade.php`:

```blade
<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container">
    <h2 class="mb-4">Create New Article</h2>
    
    <!-- Form to create new article -->
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf <!-- CSRF protection token -->
        
        <!-- Title input field -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        
        <!-- Body textarea field -->
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
        </div>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-success">Save Article</button>
    </form>
</div>
@endsection
```

#### **🔍 Create Form Explained:**

- **`method="POST"`**: Sends form data via POST request
- **`action="{{ route('articles.store') }}"`**: Form submits to the store route
- **`@csrf`**: Adds CSRF token for security
- **`name="title"` and `name="body"`**: Field names that match controller validation
- **`value="{{ old('title') }}"`**: Preserves form data if validation fails
- **`required`**: HTML5 validation - prevents empty submissions

#### **Controller Store Method:**

```php
// Save a new article
public function store(Request $request)
{
    // Validate the form data
    $data = $request->validate([
        'title' => 'required|string|max:255', // Title is required, max 255 characters
        'body' => 'required|string',          // Body is required
    ]);

    // Create article for the current user
    $request->user()->articles()->create($data);

    // Redirect with success message
    return redirect()->route('articles.index')->with('success', 'Article created successfully!');
}
```

### **7.2 Read Operation**

#### **Articles Index Page (Public View)**

Create `resources/views/articles/index.blade.php`:

```blade
<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container">
    <h1>All Articles</h1>

    <!-- @auth - Show this only to logged-in users -->
    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">+ New Article</a>
    @endauth

    <!-- @foreach - Loop through all articles -->
    @foreach($articles as $article)
        <div class="card my-3">
            <div class="card-body">
                <h4>{{ $article->title }}</h4> <!-- Display article title -->
                <p>{{ $article->body }}</p> <!-- Display article content -->
                <p class="text-muted">By {{ $article->user->name }}</p> <!-- Show author name -->

                <!-- @can - Show edit button only if user can update this article -->
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                @endcan

                <!-- @can - Show delete button only if user can delete this article -->
                @can('delete', $article)
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
                        @csrf <!-- CSRF protection token -->
                        @method('DELETE') <!-- Override method to DELETE -->
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
</div>
@endsection
```

#### **🔍 Blade Directives in Articles Index Explained:**

- **`@auth` ... `@endauth`**: Shows content only to authenticated users
- **`@foreach($articles as $article)`**: Loops through all articles
- **`{{ $article->title }}`**: Displays article title (escaped for security)
- **`{{ $article->body }}`**: Displays article content
- **`{{ $article->user->name }}`**: Shows the author's name (using relationship)
- **`@can('update', $article)`**: Checks if user can update this specific article
- **`@can('delete', $article)`**: Checks if user can delete this specific article
- **`@csrf`**: Adds CSRF token to protect against cross-site request forgery
- **`@method('DELETE')`**: Overrides form method to DELETE (HTML forms only support GET/POST)
- **`{{ route('articles.edit', $article) }}`**: Generates URL for edit route

#### **Controller Index Method:**

```php
// Display all articles
public function index()
{
    // Get all articles with their authors (eager loading for performance)
    $articles = Article::with('user')->latest()->get();
    return view('articles.index', compact('articles'));
}
```

### **7.3 Update Operation**

#### **Edit Article Form**

Create `resources/views/articles/edit.blade.php`:

```blade
<!-- Use the main layout -->
@extends('layouts.app')

<!-- Define the main content -->
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Article</h2>
    
    <!-- Form to update existing article -->
    <form method="POST" action="{{ route('articles.update', $article) }}">
        @csrf <!-- CSRF protection token -->
        @method('PUT') <!-- Override method to PUT for updates -->
        
        <!-- Title input field with current value -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
        </div>
        
        <!-- Body textarea field with current value -->
        <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body', $article->body) }}</textarea>
        </div>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
@endsection
```

#### **🔍 Edit Form Explained:**

- **`method="POST"`**: Form method (will be overridden to PUT)
- **`@method('PUT')`**: Overrides form method to PUT for updates
- **`action="{{ route('articles.update', $article) }}"`**: Form submits to update route with article ID
- **`value="{{ old('title', $article->title) }}"`**: Shows old input or current article title
- **`{{ old('body', $article->body) }}`**: Shows old input or current article body
- **Key difference**: Edit form pre-fills with existing article data

#### **Controller Update Method:**

```php
// Update an existing article
public function update(Request $request, Article $article)
{
    // Check if user can update this article (authorization)
    $this->authorize('update', $article);

    // Validate the form data
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    // Update the article
    $article->update($data);

    // Redirect with success message
    return redirect()->route('articles.index')->with('success', 'Article updated!');
}
```

### **7.4 Delete Operation**

#### **Delete Button in Index Page:**

The delete functionality is already included in the index page above. Here's the specific part:

```blade
<!-- @can - Show delete button only if user can delete this article -->
@can('delete', $article)
    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
        @csrf <!-- CSRF protection token -->
        @method('DELETE') <!-- Override method to DELETE -->
        <button class="btn btn-danger btn-sm">Delete</button>
    </form>
@endcan
```

#### **Controller Destroy Method:**

```php
// Delete an article
public function destroy(Article $article)
{
    // Check if user can delete this article (authorization)
    $this->authorize('delete', $article);
    
    // Delete the article
    $article->delete();

    // Redirect with success message
    return redirect()->route('articles.index')->with('success', 'Article deleted!');
}
```

---

## 📝 الشرح بالعربية - Basic CRUD Operations

**عمليات CRUD الأساسية:**
- **Create**: إنشاء مقال جديد
- **Read**: عرض المقالات
- **Update**: تحديث مقال موجود
- **Delete**: حذف مقال

**العمليات المهمة:**
- `validate()`: التحقق من صحة البيانات
- `create()`: إنشاء سجل جديد
- `update()`: تحديث سجل موجود
- `delete()`: حذف سجل
- `with('user')`: تحميل البيانات المرتبطة

---

## ✅ Checklist

- [ ] Create form created
- [ ] Index page created
- [ ] Edit form created
- [ ] Delete functionality added
- [ ] Controller methods implemented
- [ ] Validation rules added
- [ ] Authorization checks added
- [ ] Success messages added
- [ ] Error handling added

---

## 🚨 Common Issues & Solutions

### **Issue: Form not submitting**
```html
<!-- Check if CSRF token is included -->
@csrf

<!-- Check if method is correct -->
@method('PUT') <!-- for updates -->
@method('DELETE') <!-- for deletes -->
```

### **Issue: Validation errors not showing**
```blade
<!-- Add error display -->
@error('title')
    <div class="text-danger">{{ $message }}</div>
@enderror
```

### **Issue: Authorization errors**
```php
// Make sure Policy is created
php artisan make:policy ArticlePolicy --model=Article

// Register Policy in AuthServiceProvider
protected $policies = [
    Article::class => ArticlePolicy::class,
];
```

---

## 🔍 Testing CRUD Operations

### **7.5 Test Each Operation**

```bash
# Start development server
php artisan serve

# Test Create:
# 1. Login to your account
# 2. Go to /articles/create
# 3. Fill out the form
# 4. Submit and check if article appears in list

# Test Read:
# 1. Go to /articles
# 2. Check if articles are displayed
# 3. Check if author names are shown

# Test Update:
# 1. Click "Edit" on an article you own
# 2. Make changes and submit
# 3. Check if changes are saved

# Test Delete:
# 1. Click "Delete" on an article you own
# 2. Check if article is removed from list
```

### **7.6 Test Authorization**

```bash
# Test without login:
# 1. Logout
# 2. Try to access /articles/create
# 3. Should redirect to login

# Test with different users:
# 1. Create article with User A
# 2. Login as User B
# 3. Try to edit User A's article
# 4. Should show authorization error
```

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Authorization & Policies** - Set up user permissions
2. **Testing with Seeders & Factories** - Add test data
3. **Views & Layouts** - Improve the UI

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 