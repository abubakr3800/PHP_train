# Step 8: Authorization & Policies

## 🛡️ Authorization & Policies

### **8.1 Create Article Policy**

```bash
# Create a policy for the Article model
php artisan make:policy ArticlePolicy --model=Article
```

### **8.2 Policy Implementation**

Edit `app/Policies/ArticlePolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    // Check if user can update this article
    public function update(User $user, Article $article)
    {
        // Only the article author can update it
        return $user->id === $article->user_id;
    }

    // Check if user can delete this article
    public function delete(User $user, Article $article)
    {
        // Only the article author can delete it
        return $user->id === $article->user_id;
    }
}
```

#### **🔍 Policy Methods Explained:**

- **`update()` method**: Checks if user can edit the article (only author can)
- **`delete()` method**: Checks if user can delete the article (only author can)
- **`$user->id === $article->user_id`**: Compares user ID with article author ID
- **Returns `true` or `false`**: Determines if the action is allowed

### **8.3 Register Policy in AuthServiceProvider**

Edit `app/Providers/AuthServiceProvider.php`:

```php
<?php

namespace App\Providers;

use App\Models\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    // Register the Article policy
    protected $policies = [
        \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
```

#### **🔍 Policy Registration Explained:**

- **`protected $policies`**: Maps models to their policies
- **`Article::class => ArticlePolicy::class`**: Links Article model to ArticlePolicy
- **`registerPolicies()`**: Registers all policies in the array

### **8.4 Using Authorization in Controllers**

Update your `ArticleController.php` to use authorization:

```php
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    // Enable authorization methods (authorize, can, etc.)
    use AuthorizesRequests;

    // Show the edit article form
    public function edit(Article $article)
    {
        // Check if user can update this article (authorization)
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

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
}
```

#### **🔍 Authorization in Controllers Explained:**

- **`use AuthorizesRequests`**: Enables authorization methods like `authorize()`
- **`$this->authorize('update', $article)`**: Checks if user can update this specific article
- **`$this->authorize('delete', $article)`**: Checks if user can delete this specific article
- **If authorization fails**: Laravel automatically returns a 403 Forbidden response

### **8.5 Using Authorization in Views**

Update your `resources/views/articles/index.blade.php`:

```blade
<!-- @foreach - Loop through all articles -->
@foreach($articles as $article)
    <div class="card my-3">
        <div class="card-body">
            <h4>{{ $article->title }}</h4>
            <p>{{ $article->body }}</p>
            <p class="text-muted">By {{ $article->user->name }}</p>

            <!-- @can - Show edit button only if user can update this article -->
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">Edit</a>
            @endcan

            <!-- @can - Show delete button only if user can delete this article -->
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
```

#### **🔍 Blade Authorization Directives Explained:**

- **`@can('update', $article)`**: Checks if user can update this specific article
- **`@can('delete', $article)`**: Checks if user can delete this specific article
- **Only shows buttons to authorized users**: Prevents unauthorized access
- **Uses the Policy**: Automatically calls the policy methods

---

## 📝 الشرح بالعربية - Authorization & Policies

**الصلاحيات والسياسات:**
- **Policies**: قواعد تحكم في الصلاحيات
- **Authorization**: التحقق من صلاحيات المستخدم
- **User Ownership**: المستخدم يمكنه إدارة مقالاته فقط
- **Security**: حماية البيانات من الوصول غير المصرح

**المفاهيم المهمة:**
- `@can('update', $article)`: التحقق من صلاحية التحديث
- `@can('delete', $article)`: التحقق من صلاحية الحذف
- `authorize()`: فحص الصلاحيات في التحكم
- `$user->id === $article->user_id`: مقارنة معرف المستخدم

---

## ✅ Checklist

- [ ] ArticlePolicy created
- [ ] Policy methods implemented
- [ ] Policy registered in AuthServiceProvider
- [ ] Authorization checks added to controller
- [ ] Authorization directives added to views
- [ ] Policy methods tested
- [ ] Unauthorized access blocked
- [ ] Authorized access allowed

---

## 🚨 Common Issues & Solutions

### **Issue: Policy not found**
```bash
# Clear autoload cache
composer dump-autoload

# Check if policy exists
ls app/Policies/

# Make sure policy is registered
# Check app/Providers/AuthServiceProvider.php
```

### **Issue: Authorization not working**
```php
// Make sure you have proper imports
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// Make sure policy is registered
protected $policies = [
    Article::class => ArticlePolicy::class,
];
```

### **Issue: @can directive not working**
```blade
<!-- Make sure you're using the correct syntax -->
@can('update', $article)
    <!-- Content here -->
@endcan
```

---

## 🔍 Testing Authorization

### **8.6 Test Policy Methods**

```bash
# Open Laravel Tinker
php artisan tinker

# Test policy methods
>>> $user = User::first()
>>> $article = Article::first()
>>> $user->can('update', $article)
>>> $user->can('delete', $article)

# Test with different users
>>> $user2 = User::find(2)
>>> $user2->can('update', $article) // Should be false if not the author

# Exit tinker
>>> exit
```

### **8.7 Test Authorization in Browser**

```bash
# Start development server
php artisan serve

# Test scenarios:
# 1. Create article with User A
# 2. Login as User B
# 3. Try to edit User A's article
# 4. Should show 403 error or redirect

# Test authorized access:
# 1. Login as User A
# 2. Try to edit User A's article
# 3. Should work normally
```

### **8.8 Test View Authorization**

```blade
<!-- Test in browser -->
<!-- 1. Login as article author - should see Edit/Delete buttons -->
<!-- 2. Login as different user - should not see Edit/Delete buttons -->
<!-- 3. Logout - should not see Edit/Delete buttons -->
```

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Testing with Seeders & Factories** - Add test data
2. **Error Handling** - Improve error messages
3. **UI Improvements** - Enhance the user interface

---

## 🛠️ Additional Authorization Features

### **8.9 Advanced Policy Methods**

```php
// Add more policy methods if needed
public function viewAny(User $user)
{
    // Anyone can view articles
    return true;
}

public function view(User $user, Article $article)
{
    // Anyone can view individual articles
    return true;
}

public function create(User $user)
{
    // Only authenticated users can create articles
    return true;
}
```

### **8.10 Custom Authorization Messages**

```php
// In your policy
public function update(User $user, Article $article)
{
    if ($user->id !== $article->user_id) {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            'You can only edit your own articles.'
        );
    }
    
    return true;
}
```

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 