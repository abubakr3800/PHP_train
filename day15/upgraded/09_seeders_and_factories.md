# Step 9: Testing with Seeders & Factories

## 🧪 Add Fake Data with Seeder and Check Data

### **9.1 Create Database Seeder**

```bash
# Create a seeder to populate database with test data
php artisan make:seeder DatabaseSeeder
```

### **9.2 Seeder Implementation**

Edit `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'], // Check if user with this email exists
            ['name' => 'Test User', 'password' => bcrypt('password')] // Create with these values
        );

        // Create 5 fake articles for the test user
        $user->articles()->createMany(
            Article::factory()->count(5)->make()->toArray()
        );

        // Create additional users with articles
        User::factory(3)->create()->each(function ($user) {
            $user->articles()->createMany(
                Article::factory()->count(rand(1, 3))->make()->toArray()
            );
        });
    }
}
```

#### **🔍 Seeder Explained:**

- **`firstOrCreate()`**: Creates user only if it doesn't exist (prevents duplicates)
- **`bcrypt('password')`**: Hashes the password for security
- **`createMany()`**: Creates multiple articles at once
- **`factory()->count(5)`**: Creates 5 articles
- **`make()`**: Creates article instances without saving to database
- **`toArray()`**: Converts to array for bulk creation

### **9.3 Create Article Factory**

```bash
# Create a factory for generating fake article data
php artisan make:factory ArticleFactory --model=Article
```

### **9.4 Factory Implementation**

Edit `database/factories/ArticleFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), // Generate fake sentence for title
            'body' => $this->faker->paragraph(), // Generate fake paragraph for body
            'user_id' => User::factory(), // Create a user for this article
        ];
    }
}
```

#### **🔍 Factory Explained:**

- **`$this->faker->sentence()`**: Generates random sentences for titles
- **`$this->faker->paragraph()`**: Generates random paragraphs for content
- **`User::factory()`**: Creates a new user for each article
- **Faker library**: Provides realistic fake data

### **9.5 Generate Test Data**

```bash
# Populate database with test data
php artisan db:seed
```

#### **🔍 What the Seeder Creates:**

- **1 Test User**: `test@example.com` with password `password`
- **5 Articles**: For the test user
- **3 Additional Users**: Each with 1-3 articles
- **Total**: ~10-15 articles for testing

---

## 📝 الشرح بالعربية - Testing with Seeders & Factories

**الاختبار والبذور والمصانع:**
- **Seeders**: ملء قاعدة البيانات ببيانات تجريبية
- **Factories**: إنشاء بيانات وهمية للاختبار
- **Faker**: مكتبة لإنشاء بيانات واقعية
- **Testing Data**: بيانات للاختبار والتطوير

**الأوامر المهمة:**
- `php artisan make:seeder`: إنشاء بذور جديدة
- `php artisan make:factory`: إنشاء مصنع جديد
- `php artisan db:seed`: تشغيل البذور
- `$this->faker->sentence()`: إنشاء جملة عشوائية

---

## ✅ Checklist

- [ ] DatabaseSeeder created
- [ ] ArticleFactory created
- [ ] Test user created
- [ ] Fake articles generated
- [ ] Seeder run successfully
- [ ] Data verified in database
- [ ] Test data accessible in app
- [ ] Multiple users with articles created

---

## 🚨 Common Issues & Solutions

### **Issue: Seeder not found**
```bash
# Clear autoload cache
composer dump-autoload

# Check if seeder exists
ls database/seeders/
```

### **Issue: Factory not working**
```php
// Make sure you have proper imports
use App\Models\User;
use App\Models\Article;
```

### **Issue: Duplicate data**
```php
// Use firstOrCreate to prevent duplicates
User::firstOrCreate(
    ['email' => 'test@example.com'],
    ['name' => 'Test User', 'password' => bcrypt('password')]
);
```

---

## 🔍 Testing Seeders and Factories

### **9.6 Test with Tinker**

```bash
# Open Laravel Tinker
php artisan tinker

# Check if test user exists
>>> User::where('email', 'test@example.com')->first()

# Check if articles were created
>>> Article::count()

# Check articles for test user
>>> $user = User::where('email', 'test@example.com')->first()
>>> $user->articles

# Test factory
>>> Article::factory()->create()

# Exit tinker
>>> exit
```

### **9.7 Test in Browser**

```bash
# Start development server
php artisan serve

# Test scenarios:
# 1. Go to /articles
# 2. Check if articles are displayed
# 3. Login with test@example.com / password
# 4. Check if you can edit your articles
# 5. Check if you can't edit others' articles
```

### **9.8 Verify Data in Database**

```sql
-- Check users table
SELECT * FROM users;

-- Check articles table
SELECT * FROM articles;

-- Check relationships
SELECT articles.*, users.name as author_name 
FROM articles 
JOIN users ON articles.user_id = users.id;
```

---

## 📚 Next Steps

After completing this step, proceed to:
1. **Error Handling** - Improve error messages
2. **UI Improvements** - Enhance the user interface
3. **Testing** - Write automated tests

---

## 🛠️ Additional Seeder Features

### **9.9 Advanced Seeder**

```php
// In DatabaseSeeder.php
public function run(): void
{
    // Create admin user
    User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin User',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
        ]
    );

    // Create regular users
    User::factory(5)->create()->each(function ($user) {
        // Create 2-5 articles per user
        $user->articles()->createMany(
            Article::factory()->count(rand(2, 5))->make()->toArray()
        );
    });

    // Create featured articles
    Article::factory(3)->create([
        'title' => 'Featured: ' . fake()->sentence(),
        'body' => fake()->paragraphs(3, true),
    ]);
}
```

### **9.10 Custom Factory States**

```php
// In ArticleFactory.php
public function featured(): static
{
    return $this->state(fn (array $attributes) => [
        'title' => 'Featured: ' . fake()->sentence(),
        'body' => fake()->paragraphs(3, true),
    ]);
}

// Usage in seeder
Article::factory()->featured()->count(3)->create();
```

---

## 🧪 Testing Commands

### **Useful Commands:**

```bash
# Run seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=DatabaseSeeder

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Reset and seed
php artisan migrate:reset
php artisan migrate
php artisan db:seed
```

### **Factory Testing:**

```bash
# Test factory in tinker
php artisan tinker
>>> Article::factory()->create()
>>> User::factory()->create()
>>> exit
```

---

> **Created by Ahmed Mohamed Abubakr** [@https://abubakr.rf.gd/] 