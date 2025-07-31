## 📄 شرح عرض المقالات للجميع مع حماية إضافة وتعديل وحذف المقالات في Laravel

---

### ✅ الهدف

- عرض جميع المقالات لكل الزوار.
- السماح فقط للمستخدمين المسجلين بإضافة وتعديل وحذف المقالات باستخدام نظام التفويض (Policy & authorize).

---

### 🧹 1. **Route التعريفات**

```php
use App\Http\Controllers\ArticleController;

// عرض المقالات للجميع
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// عمليات CRUD محمية للمسجلين فقط
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
});
```

---

### 🛠️ 2. **ربط ArticleController بالـ Article Model**

تأكد من:

1. وجود الـ Model:

```bash
php artisan make:model Article -m
```

2. استدعاء الـ Model داخل الكنترولر:

```php
use App\Models\Article;
```

3. في `ArticleController` استخدم `Article::` بدلاً من كتابة `App\Http\Controllers\Article` عن طريق كتابة:

```php
use App\Models\Article;
```

فوق الكلاس مباشرة.

---

### 🏠 3. **إنشاء صفحة articles.index باستخدام layout**

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

> تأكد إن `layouts.app` موجود ويحتوي على `@vite()` و `@yield('content')`

---

### 🧠 5. **تابع index لعرض كل المقالات**

```php
public function index()
{
    $articles = \App\Models\Article::with('user')->latest()->get();
    return view('articles.index', compact('articles'));
}
```

> تأكد إن في Article model فيه علاقة `user()`:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

---

### **Slide 4.1: التعامل مع Seeder لتجهيز بيانات تجريبية**

🌱 نستخدم Seeder لإنشاء مستخدم وهمي لتجربة المشروع:

```php
use App\Models\User;

public function run(): void
{
    User::firstOrCreate(
        ['email' => 'test@example.com'],
        ['name' => 'Test User', 'password' => bcrypt('password')]
    );
}
```

📝 الفائدة: نتفادى تكرار المستخدم لو شغّلنا seeder أكثر من مرة.

---

### **Slide 4.2: إضافة Factory لتوليد مقالات تجريبية**

🏭 **إنشاء factory خاص بالمقالات:**

```bash
php artisan make:factory ArticleFactory --model=Article
```

📄 في `ArticleFactory.php`:

```php
use App\Models\User;

public function definition(): array
{
    return [
        'title' => $this->faker->sentence(),
        'body' => $this->faker->paragraph(),
        'user_id' => User::factory(),
    ];
}
```
---

🧩 فعل `HasFactory` داخل `Article.php`:

```php
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id'];
}
```

📦 أنشئ 5 مقالات مرتبطة بالمستخدم:

```php
$user = User::firstOrCreate(
    ['email' => 'test@example.com'],
    ['name' => 'Test User', 'password' => bcrypt('password')]
);

$user->articles()->createMany(
    \App\Models\Article::factory()->count(5)->make()->toArray()
);
```

🔗 تأكد من وجود العلاقة في `User.php`:

```php
public function articles()
{
    return $this->hasMany(\App\Models\Article::class);
}
```

---

### 🏗️ 6. **إنشاء Article Policy**

```bash
php artisan make:policy ArticlePolicy --model=Article
```

ثم عدل الملف `app/Policies/ArticlePolicy.php`:

```php
namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }
}
```

---

### 🛡️ 4. **تفعيل التفويض (Authorization) في الكنترولر**

في بداية `ArticleController.php`:

```php
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;
    // باقي الكود
```
## ثم في كل متود في الكنترولر: `authorize()`: 
---

### 🔗 7. **تسجيل الـ Policy في AuthServiceProvider**

```php
protected $policies = [
    \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
];
```

---

### 🧾 8. **ملف view لعرض المقالات**

`resources/views/articles/index.blade.php`

```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Articles</h1>

    @auth
        <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">+ New Article</a>
    @endauth

    @foreach($articles as $article)
        <div class="card my-3">
            <div class="card-body">
                <h4>{{ $article->title }}</h4>
                <p>{{ $article->body }}</p>
                <p class="text-muted">By {{ $article->user->name }}</p>

                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
                @endcan

                @can('delete', $article)
                    <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach
</div>
@endsection
```


---

### **Slide 8.1: عمليات CRUD (Create - Edit - Delete) في Laravel**

#### ✍️ Create:

```php
public function create() {
    return view('articles.create');
}

public function store(Request $request) {
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $request->user()->articles()->create($data);

    return redirect()->route('articles.index')->with('success', 'Article created successfully!');
}
```

```blade
<!-- resources/views/articles/create.blade.php -->
<form method="POST" action="{{ route('articles.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Body</label>
        <textarea name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
```

#### 🛠️ Edit + Update:

```php
public function edit(Article $article) {
    $this->authorize('update', $article);
    return view('articles.edit', compact('article'));
}

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

```blade
<!-- resources/views/articles/edit.blade.php -->
<form method="POST" action="{{ route('articles.update', $article) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Body</label>
        <textarea name="body" class="form-control" rows="5">{{ old('body', $article->body) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
```

#### 🗑️ Delete:

```php
public function destroy(Article $article) {
    $this->authorize('delete', $article);
    $article->delete();

    return redirect()->route('articles.index')->with('success', 'Article deleted!');
}
```

---

### ✅ النتيجة

- الزوار يشاهدون جميع المقالات.
- المستخدم المسجل فقط يمكنه إدارة مقالاته.
- استخدام `authorize()` مع السياسات يحمي العمليات الحساسة.

---

### 🧭 9. **تصميم صفحة Dashboard**

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

### 🔐 10. **تصميم صفحة Login**

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

### 🌟 11. **تصميم صفحة Register**

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

