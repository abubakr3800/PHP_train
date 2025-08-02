# 🌱 Step 9: Seeders and Factories for Teaching System

## 📋 Overview
In this step, we'll create comprehensive seeders and factories to populate our Teaching System with realistic test data. This will help us test all functionality and provide a working demo of the system.

## 🎯 Objectives
- Create factories for all models
- Create seeders with realistic data
- Populate database with test data
- Create demo users for different roles
- Ensure data relationships are properly established
- Test all CRUD operations with seeded data

## 📁 Files to Create/Modify
- `database/factories/` (All factory files)
- `database/seeders/` (All seeder files)
- `app/Models/` (Update models for factories)

---

## 🚀 Step-by-Step Implementation

### 1. Create Student Factory

Create `database/factories/StudentFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        $genders = ['male', 'female'];
        $statuses = ['active', 'inactive', 'pending'];
        
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'student_id' => 'STU' . $this->faker->unique()->numberBetween(1000, 9999),
            'phone' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'gender' => $this->faker->randomElement($genders),
            'address' => $this->faker->address(),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'inactive',
            ];
        });
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }
}
```

### 2. Create Course Factory

Create `database/factories/CourseFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        $levels = ['beginner', 'intermediate', 'advanced'];
        $statuses = ['active', 'inactive', 'draft'];
        
        $courseTitles = [
            'Introduction to Computer Science',
            'Advanced Mathematics',
            'English Literature',
            'Physics Fundamentals',
            'Chemistry Lab',
            'History of Art',
            'Business Management',
            'Psychology Basics',
            'Economics Principles',
            'Biology Essentials',
            'Programming Fundamentals',
            'Data Science Basics',
            'Web Development',
            'Mobile App Development',
            'Database Management',
            'Network Security',
            'Artificial Intelligence',
            'Machine Learning',
            'Digital Marketing',
            'Graphic Design'
        ];

        return [
            'title' => $this->faker->randomElement($courseTitles),
            'code' => 'CS' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(3),
            'credits' => $this->faker->numberBetween(1, 6),
            'level' => $this->faker->randomElement($levels),
            'status' => $this->faker->randomElement($statuses),
            'duration' => $this->faker->numberBetween(30, 120), // hours
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    public function beginner()
    {
        return $this->state(function (array $attributes) {
            return [
                'level' => 'beginner',
            ];
        });
    }

    public function intermediate()
    {
        return $this->state(function (array $attributes) {
            return [
                'level' => 'intermediate',
            ];
        });
    }

    public function advanced()
    {
        return $this->state(function (array $attributes) {
            return [
                'level' => 'advanced',
            ];
        });
    }
}
```

### 3. Create Teacher Factory

Create `database/factories/TeacherFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        $genders = ['male', 'female'];
        $statuses = ['active', 'inactive', 'pending'];
        $departments = [
            'Computer Science',
            'Mathematics',
            'English',
            'Physics',
            'Chemistry',
            'Art History',
            'Business',
            'Psychology',
            'Economics',
            'Biology'
        ];

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'teacher_id' => 'TCH' . $this->faker->unique()->numberBetween(100, 999),
            'phone' => $this->faker->phoneNumber(),
            'date_of_birth' => $this->faker->date('Y-m-d', '-25 years'),
            'gender' => $this->faker->randomElement($genders),
            'address' => $this->faker->address(),
            'department' => $this->faker->randomElement($departments),
            'qualification' => $this->faker->randomElement(['PhD', 'Masters', 'Bachelors']),
            'experience_years' => $this->faker->numberBetween(1, 20),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    public function experienced()
    {
        return $this->state(function (array $attributes) {
            return [
                'experience_years' => $this->faker->numberBetween(5, 20),
            ];
        });
    }
}
```

### 4. Create Enrollment Factory

Create `database/factories/EnrollmentFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition()
    {
        $statuses = ['active', 'completed', 'dropped', 'pending'];
        
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'teacher_id' => Teacher::factory(),
            'enrollment_date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'grade' => $this->faker->optional(0.8)->numberBetween(50, 100),
            'status' => $this->faker->randomElement($statuses),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'grade' => $this->faker->numberBetween(60, 100),
            ];
        });
    }

    public function withGrade()
    {
        return $this->state(function (array $attributes) {
            return [
                'grade' => $this->faker->numberBetween(50, 100),
            ];
        });
    }
}
```

### 5. Create User Factory

Update `database/factories/UserFactory.php`:

```php
<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Default password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'admin@teachingsystem.com',
                'name' => 'System Administrator',
            ];
        })->afterCreating(function (User $user) {
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole) {
                $user->roles()->attach($adminRole->id);
            }
        });
    }

    public function teacher()
    {
        return $this->afterCreating(function (User $user) {
            $teacherRole = Role::where('name', 'teacher')->first();
            if ($teacherRole) {
                $user->roles()->attach($teacherRole->id);
            }
        });
    }

    public function student()
    {
        return $this->afterCreating(function (User $user) {
            $studentRole = Role::where('name', 'student')->first();
            if ($studentRole) {
                $user->roles()->attach($studentRole->id);
            }
        });
    }
}
```

### 6. Create Main Seeder

Update `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            TeacherSeeder::class,
            EnrollmentSeeder::class,
        ]);
    }
}
```

### 7. Create User Seeder

Create `database/seeders/UserSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@teachingsystem.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->roles()->attach($adminRole->id);
        }

        // Create demo teacher users
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole) {
            for ($i = 1; $i <= 5; $i++) {
                $teacher = User::create([
                    'name' => "Teacher {$i}",
                    'email' => "teacher{$i}@teachingsystem.com",
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]);
                $teacher->roles()->attach($teacherRole->id);
            }
        }

        // Create demo student users
        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole) {
            for ($i = 1; $i <= 10; $i++) {
                $student = User::create([
                    'name' => "Student {$i}",
                    'email' => "student{$i}@teachingsystem.com",
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]);
                $student->roles()->attach($studentRole->id);
            }
        }

        // Create additional random users
        User::factory(20)->create()->each(function ($user) {
            $roles = Role::inRandomOrder()->take(rand(1, 2))->get();
            $user->roles()->attach($roles->pluck('id'));
        });
    }
}
```

### 8. Create Student Seeder

Create `database/seeders/StudentSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Create 50 students with realistic data
        Student::factory(50)->create();

        // Create additional students with specific statuses
        Student::factory(20)->active()->create();
        Student::factory(10)->inactive()->create();
        Student::factory(5)->pending()->create();

        $this->command->info('Students seeded successfully!');
    }
}
```

### 9. Create Course Seeder

Create `database/seeders/CourseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Create 30 courses with realistic data
        Course::factory(30)->create();

        // Create courses with specific levels
        Course::factory(10)->beginner()->active()->create();
        Course::factory(10)->intermediate()->active()->create();
        Course::factory(10)->advanced()->active()->create();

        // Create some inactive courses
        Course::factory(5)->inactive()->create();

        $this->command->info('Courses seeded successfully!');
    }
}
```

### 10. Create Teacher Seeder

Create `database/seeders/TeacherSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        // Create 20 teachers with realistic data
        Teacher::factory(20)->create();

        // Create additional teachers with specific statuses
        Teacher::factory(15)->active()->create();
        Teacher::factory(5)->inactive()->create();

        // Create experienced teachers
        Teacher::factory(10)->experienced()->active()->create();

        $this->command->info('Teachers seeded successfully!');
    }
}
```

### 11. Create Enrollment Seeder

Create `database/seeders/EnrollmentSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        // Get existing students, courses, and teachers
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();

        if ($students->count() > 0 && $courses->count() > 0 && $teachers->count() > 0) {
            // Create enrollments for each student
            foreach ($students as $student) {
                // Enroll each student in 1-4 random courses
                $randomCourses = $courses->random(rand(1, min(4, $courses->count())));
                
                foreach ($randomCourses as $course) {
                    $teacher = $teachers->random();
                    
                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'teacher_id' => $teacher->id,
                        'enrollment_date' => now()->subDays(rand(1, 180)),
                        'grade' => rand(0, 1) ? rand(60, 100) : null, // 50% chance of having a grade
                        'status' => rand(0, 1) ? 'active' : 'completed',
                    ]);
                }
            }

            // Create some additional enrollments with different statuses
            Enrollment::factory(50)->active()->create();
            Enrollment::factory(20)->completed()->create();
            Enrollment::factory(10)->withGrade()->create();
        }

        $this->command->info('Enrollments seeded successfully!');
    }
}
```

### 12. Create Demo Data Seeder

Create `database/seeders/DemoDataSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Creating demo data...');

        // Create demo students
        $students = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@student.com',
                'student_id' => 'STU1001',
                'phone' => '+1234567890',
                'date_of_birth' => '2000-05-15',
                'gender' => 'male',
                'address' => '123 Main St, City, State',
                'status' => 'active',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@student.com',
                'student_id' => 'STU1002',
                'phone' => '+1234567891',
                'date_of_birth' => '1999-08-22',
                'gender' => 'female',
                'address' => '456 Oak Ave, City, State',
                'status' => 'active',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@student.com',
                'student_id' => 'STU1003',
                'phone' => '+1234567892',
                'date_of_birth' => '2001-03-10',
                'gender' => 'male',
                'address' => '789 Pine Rd, City, State',
                'status' => 'active',
            ],
        ];

        foreach ($students as $studentData) {
            Student::create($studentData);
        }

        // Create demo courses
        $courses = [
            [
                'title' => 'Introduction to Computer Science',
                'code' => 'CS101',
                'description' => 'Fundamental concepts of computer science and programming.',
                'credits' => 3,
                'level' => 'beginner',
                'status' => 'active',
                'duration' => 45,
            ],
            [
                'title' => 'Advanced Mathematics',
                'code' => 'MATH201',
                'description' => 'Advanced mathematical concepts and problem-solving techniques.',
                'credits' => 4,
                'level' => 'intermediate',
                'status' => 'active',
                'duration' => 60,
            ],
            [
                'title' => 'English Literature',
                'code' => 'ENG101',
                'description' => 'Study of classic and contemporary literature.',
                'credits' => 3,
                'level' => 'beginner',
                'status' => 'active',
                'duration' => 45,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        // Create demo teachers
        $teachers = [
            [
                'name' => 'Dr. Robert Wilson',
                'email' => 'robert.wilson@teacher.com',
                'teacher_id' => 'TCH101',
                'phone' => '+1234567893',
                'date_of_birth' => '1975-12-05',
                'gender' => 'male',
                'address' => '321 Elm St, City, State',
                'department' => 'Computer Science',
                'qualification' => 'PhD',
                'experience_years' => 15,
                'status' => 'active',
            ],
            [
                'name' => 'Prof. Emily Davis',
                'email' => 'emily.davis@teacher.com',
                'teacher_id' => 'TCH102',
                'phone' => '+1234567894',
                'date_of_birth' => '1980-07-18',
                'gender' => 'female',
                'address' => '654 Maple Dr, City, State',
                'department' => 'Mathematics',
                'qualification' => 'Masters',
                'experience_years' => 10,
                'status' => 'active',
            ],
            [
                'name' => 'Dr. James Miller',
                'email' => 'james.miller@teacher.com',
                'teacher_id' => 'TCH103',
                'phone' => '+1234567895',
                'date_of_birth' => '1978-04-25',
                'gender' => 'male',
                'address' => '987 Cedar Ln, City, State',
                'department' => 'English',
                'qualification' => 'PhD',
                'experience_years' => 12,
                'status' => 'active',
            ],
        ];

        foreach ($teachers as $teacherData) {
            Teacher::create($teacherData);
        }

        // Create demo enrollments
        $enrollments = [
            [
                'student_id' => 1, // John Smith
                'course_id' => 1, // CS101
                'teacher_id' => 1, // Dr. Robert Wilson
                'enrollment_date' => '2024-01-15',
                'grade' => 85,
                'status' => 'active',
            ],
            [
                'student_id' => 2, // Sarah Johnson
                'course_id' => 2, // MATH201
                'teacher_id' => 2, // Prof. Emily Davis
                'enrollment_date' => '2024-01-20',
                'grade' => 92,
                'status' => 'active',
            ],
            [
                'student_id' => 3, // Michael Brown
                'course_id' => 3, // ENG101
                'teacher_id' => 3, // Dr. James Miller
                'enrollment_date' => '2024-01-25',
                'grade' => 78,
                'status' => 'active',
            ],
        ];

        foreach ($enrollments as $enrollmentData) {
            Enrollment::create($enrollmentData);
        }

        $this->command->info('Demo data created successfully!');
    }
}
```

### 13. Run the Seeders

Execute the seeders:

```bash
# Run all seeders
php artisan db:seed

# Run specific seeders
php artisan db:seed --class=RolePermissionSeeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=StudentSeeder
php artisan db:seed --class=CourseSeeder
php artisan db:seed --class=TeacherSeeder
php artisan db:seed --class=EnrollmentSeeder
php artisan db:seed --class=DemoDataSeeder
```

### 14. Create Test Commands

Create `app/Console/Commands/SeedDemoData.php`:

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Enrollment;

class SeedDemoData extends Command
{
    protected $signature = 'demo:seed {--fresh : Fresh migration}';
    protected $description = 'Seed demo data for Teaching System';

    public function handle()
    {
        if ($this->option('fresh')) {
            $this->call('migrate:fresh');
        }

        $this->info('Seeding demo data...');

        // Run seeders in order
        $this->call('db:seed', ['--class' => 'RolePermissionSeeder']);
        $this->call('db:seed', ['--class' => 'UserSeeder']);
        $this->call('db:seed', ['--class' => 'StudentSeeder']);
        $this->call('db:seed', ['--class' => 'CourseSeeder']);
        $this->call('db:seed', ['--class' => 'TeacherSeeder']);
        $this->call('db:seed', ['--class' => 'EnrollmentSeeder']);
        $this->call('db:seed', ['--class' => 'DemoDataSeeder']);

        $this->info('Demo data seeded successfully!');
        $this->info('Admin login: admin@teachingsystem.com / password');
        $this->info('Teacher login: teacher1@teachingsystem.com / password');
        $this->info('Student login: student1@teachingsystem.com / password');
    }
}
```

---

## ✅ Checklist

- [ ] Student factory created with realistic data
- [ ] Course factory created with various levels
- [ ] Teacher factory created with departments
- [ ] Enrollment factory created with relationships
- [ ] User factory updated with roles
- [ ] All seeders created and configured
- [ ] Demo data seeder created
- [ ] Test command created
- [ ] Database populated with test data
- [ ] Relationships properly established
- [ ] Demo users created with roles
- [ ] Realistic test data generated

---

## 🔧 Common Issues & Solutions

### Issue: Factory relationships not working
**Solution:** Make sure models have proper relationships defined:
```php
public function enrollments()
{
    return $this->hasMany(Enrollment::class);
}
```

### Issue: Seeder not running
**Solution:** Check if seeder is registered in `DatabaseSeeder`:
```php
$this->call([
    RolePermissionSeeder::class,
    UserSeeder::class,
]);
```

### Issue: Duplicate data in seeders
**Solution:** Use `unique()` in factories:
```php
'email' => $this->faker->unique()->safeEmail(),
```

### Issue: Foreign key constraints
**Solution:** Create data in correct order (users → students → enrollments)

---

## 🌱 Seeder Features

1. **Realistic Data**: Names, emails, addresses, phone numbers
2. **Proper Relationships**: All foreign keys properly linked
3. **Status Variations**: Active, inactive, pending records
4. **Grade Distribution**: Realistic grade ranges
5. **Date Ranges**: Proper enrollment and creation dates
6. **Role Assignment**: Users assigned appropriate roles
7. **Department Assignment**: Teachers assigned to departments
8. **Course Levels**: Beginner, intermediate, advanced courses
9. **Demo Users**: Pre-created users for testing
10. **Bulk Data**: Large datasets for performance testing

---

## 🔄 Next Steps

1. **Test all CRUD operations** with seeded data
2. **Create performance tests** with large datasets
3. **Add data validation** tests
4. **Create backup/restore** functionality
5. **Implement data export** features

---

## 🌐 Arabic Translation

### البذور والمصانع لنظام التدريس

**الخطوات المطلوبة:**
1. إنشاء مصانع لجميع النماذج
2. إنشاء بذور ببيانات واقعية
3. ملء قاعدة البيانات ببيانات الاختبار
4. إنشاء مستخدمين تجريبيين لأدوار مختلفة
5. التأكد من إنشاء العلاقات بشكل صحيح

**المميزات:**
- بيانات واقعية ومتنوعة
- علاقات صحيحة بين الجداول
- مستخدمين تجريبيين جاهزين
- بيانات اختبار شاملة
- أداء محسن للاختبار

---

## 📚 Additional Resources

- [Laravel Factories](https://laravel.com/docs/factories)
- [Laravel Seeders](https://laravel.com/docs/seeders)
- [Faker Documentation](https://fakerphp.github.io/)
- [Database Testing](https://laravel.com/docs/testing#database)
- [Model Factories](https://laravel.com/docs/eloquent-factories)

---

## 🎯 Summary

In this step, we've successfully created:

- **Comprehensive Factories**: For all models with realistic data
- **Multiple Seeders**: For different data types and scenarios
- **Demo Data**: Pre-configured test data with relationships
- **Role-Based Users**: Admin, teacher, and student accounts
- **Realistic Relationships**: Proper foreign key connections
- **Test Commands**: Easy-to-use seeding commands
- **Performance Data**: Large datasets for testing

The Teaching System now has a complete set of test data ready for development and testing! 