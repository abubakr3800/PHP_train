## 🛠️ إنشاء صفحات CRUD للمقالات في Laravel

---

### **إنشاء Route و Controller و Model**

```bash
php artisan make:model Article -mfs
```

- `-m` لإنشاء migration
- `-f` لإنشاء factory
- `-s` لإنشاء seeder

---

### **جدول قاعدة البيانات للمقالات**

في ملف `database/migrations/xxxx_create_articles_table.php`

```php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('body');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

ثم:

```bash
php artisan migrate
```

---

### **إضافة بيانات وهمية باستخدام Seeder**

في `database/seeders/DatabaseSeeder.php`:

```php
use App\Models\Article;

public function run()
{
    \App\Models\User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    Article::factory(10)->create();
}
```

وفي `database/factories/ArticleFactory.php`:

```php
use App\Models\User;

public function definition(): array
{
    return [
        'title' => fake()->sentence(),
        'body' => fake()->paragraph(5),
        'user_id' => User::inRandomOrder()->first()->id,
    ];
}
```

ثم:

```bash
php artisan db:seed
```

---

### **تعريف Route للمقالات**

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticleController::class);
});
```

---

### **عرض المقالات (Index)**

```php
public function index()
{
    $articles = Article::where('user_id', auth()->id())->latest()->get();
    return view('articles.index', compact('articles'));
}
```

```blade
<!-- resources/views/articles/index.blade.php -->
<a href="{{ route('articles.create') }}" class="btn btn-primary">+ New</a>
@foreach($articles as $article)
  <div class="card my-3">
    <div class="card-body">
      <h4>{{ $article->title }}</h4>
      <p>{{ $article->body }}</p>
      <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
      <form method="POST" action="{{ route('articles.destroy', $article) }}" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-danger btn-sm">Delete</button>
      </form>
    </div>
  </div>
@endforeach
```

---

### **إنشاء مقال جديد (Create + Store)**

```php
public function create()
{
    return view('articles.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'body' => 'required',
    ]);

    Article::create([
        'title' => $request->title,
        'body' => $request->body,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('articles.index');
}
```

```blade
<!-- resources/views/articles/create.blade.php -->
<form method="POST" action="{{ route('articles.store') }}">
  @csrf
  <div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control">
  </div>
  <div class="mb-3">
    <label>Body</label>
    <textarea name="body" class="form-control"></textarea>
  </div>
  <button class="btn btn-success">Save</button>
</form>
```

---

### **تعديل مقال (Edit + Update)**

```php
public function edit(Article $article)
{
    $this->authorize('update', $article);
    return view('articles.edit', compact('article'));
}

public function update(Request $request, Article $article)
{
    $this->authorize('update', $article);

    $request->validate([
        'title' => 'required',
        'body' => 'required',
    ]);

    $article->update($request->only('title', 'body'));
    return redirect()->route('articles.index');
}
```

---

### **حذف مقال (Destroy)**

```php
public function destroy(Article $article)
{
    $this->authorize('delete', $article);
    $article->delete();
    return back();
}
```

