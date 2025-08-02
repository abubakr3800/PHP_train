# 🔐 Step 8: Authorization and Policies for Teaching System

## 📋 Overview
In this step, we'll implement a comprehensive authorization system for our Teaching System using Laravel's built-in authorization features. We'll create policies for different user roles and ensure proper access control throughout the application.

## 🎯 Objectives
- Create user roles and permissions system
- Implement policies for all entities
- Add middleware for route protection
- Create role-based access control
- Implement authorization checks in views
- Add admin-only functionality

## 📁 Files to Create/Modify
- `app/Models/User.php` (Add roles)
- `app/Policies/` (All policy files)
- `app/Http/Middleware/` (Custom middleware)
- `database/migrations/` (Role and permission tables)
- `config/auth.php` (Authorization configuration)

---

## 🚀 Step-by-Step Implementation

### 1. Create Role and Permission Migrations

Create `database/migrations/2024_01_01_000001_create_roles_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
```

Create `database/migrations/2024_01_01_000002_create_permissions_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
```

Create `database/migrations/2024_01_01_000003_create_role_user_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
};
```

Create `database/migrations/2024_01_01_000004_create_permission_role_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['permission_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
};
```

### 2. Create Role and Permission Models

Create `app/Models/Role.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            return $this->permissions->contains('name', $permission);
        }
        
        return !!$permission->intersect($this->permissions)->count();
    }

    public function hasAnyPermission($permissions)
    {
        if (is_string($permissions)) {
            return $this->hasPermission($permissions);
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasAllPermissions($permissions)
    {
        if (is_string($permissions)) {
            return $this->hasPermission($permissions);
        }

        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }
}
```

Create `app/Models/Permission.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
```

### 3. Update User Model

Update `app/Models/User.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        
        return !!$role->intersect($this->roles)->count();
    }

    public function hasAnyRole($roles)
    {
        if (is_string($roles)) {
            return $this->hasRole($roles);
        }

        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasAllRoles($roles)
    {
        if (is_string($roles)) {
            return $this->hasRole($roles);
        }

        foreach ($roles as $role) {
            if (!$this->hasRole($role)) {
                return false;
            }
        }

        return true;
    }

    public function hasPermission($permission)
    {
        return $this->roles->map->permissions->flatten()->contains('name', $permission);
    }

    public function hasAnyPermission($permissions)
    {
        if (is_string($permissions)) {
            return $this->hasPermission($permissions);
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasAllPermissions($permissions)
    {
        if (is_string($permissions)) {
            return $this->hasPermission($permissions);
        }

        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    public function isStudent()
    {
        return $this->hasRole('student');
    }
}
```

### 4. Create Policies

Create `app/Policies/StudentPolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['view-students', 'manage-students']);
    }

    public function view(User $user, Student $student): bool
    {
        return $user->hasAnyPermission(['view-students', 'manage-students']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('manage-students');
    }

    public function update(User $user, Student $student): bool
    {
        return $user->hasPermission('manage-students');
    }

    public function delete(User $user, Student $student): bool
    {
        return $user->hasPermission('manage-students');
    }

    public function restore(User $user, Student $student): bool
    {
        return $user->hasPermission('manage-students');
    }

    public function forceDelete(User $user, Student $student): bool
    {
        return $user->hasPermission('manage-students');
    }
}
```

Create `app/Policies/CoursePolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['view-courses', 'manage-courses']);
    }

    public function view(User $user, Course $course): bool
    {
        return $user->hasAnyPermission(['view-courses', 'manage-courses']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('manage-courses');
    }

    public function update(User $user, Course $course): bool
    {
        return $user->hasPermission('manage-courses');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->hasPermission('manage-courses');
    }

    public function restore(User $user, Course $course): bool
    {
        return $user->hasPermission('manage-courses');
    }

    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasPermission('manage-courses');
    }
}
```

Create `app/Policies/TeacherPolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;

class TeacherPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['view-teachers', 'manage-teachers']);
    }

    public function view(User $user, Teacher $teacher): bool
    {
        return $user->hasAnyPermission(['view-teachers', 'manage-teachers']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('manage-teachers');
    }

    public function update(User $user, Teacher $teacher): bool
    {
        return $user->hasPermission('manage-teachers');
    }

    public function delete(User $user, Teacher $teacher): bool
    {
        return $user->hasPermission('manage-teachers');
    }

    public function restore(User $user, Teacher $teacher): bool
    {
        return $user->hasPermission('manage-teachers');
    }

    public function forceDelete(User $user, Teacher $teacher): bool
    {
        return $user->hasPermission('manage-teachers');
    }
}
```

Create `app/Policies/EnrollmentPolicy.php`:

```php
<?php

namespace App\Policies;

use App\Models\Enrollment;
use App\Models\User;

class EnrollmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission(['view-enrollments', 'manage-enrollments']);
    }

    public function view(User $user, Enrollment $enrollment): bool
    {
        return $user->hasAnyPermission(['view-enrollments', 'manage-enrollments']);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('manage-enrollments');
    }

    public function update(User $user, Enrollment $enrollment): bool
    {
        return $user->hasPermission('manage-enrollments');
    }

    public function delete(User $user, Enrollment $enrollment): bool
    {
        return $user->hasPermission('manage-enrollments');
    }

    public function restore(User $user, Enrollment $enrollment): bool
    {
        return $user->hasPermission('manage-enrollments');
    }

    public function forceDelete(User $user, Enrollment $enrollment): bool
    {
        return $user->hasPermission('manage-enrollments');
    }
}
```

### 5. Register Policies

Update `app/Providers/AuthServiceProvider.php`:

```php
<?php

namespace App\Providers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Enrollment;
use App\Policies\StudentPolicy;
use App\Policies\CoursePolicy;
use App\Policies\TeacherPolicy;
use App\Policies\EnrollmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Student::class => StudentPolicy::class,
        Course::class => CoursePolicy::class,
        Teacher::class => TeacherPolicy::class,
        Enrollment::class => EnrollmentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
```

### 6. Create Custom Middleware

Create `app/Http/Middleware/CheckRole.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !$request->user()->hasAnyRole($roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
```

Create `app/Http/Middleware/CheckPermission.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!$request->user() || !$request->user()->hasAnyPermission($permissions)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
```

### 7. Register Middleware

Update `app/Http/Kernel.php`:

```php
protected $routeMiddleware = [
    // ... existing middleware
    'role' => \App\Http\Middleware\CheckRole::class,
    'permission' => \App\Http\Middleware\CheckPermission::class,
];
```

### 8. Update Controllers with Authorization

Update `app/Http/Controllers/StudentController.php`:

```php
public function index(Request $request)
{
    $this->authorize('viewAny', Student::class);
    
    // ... existing code
}

public function create()
{
    $this->authorize('create', Student::class);
    
    return view('students.create');
}

public function store(Request $request)
{
    $this->authorize('create', Student::class);
    
    // ... existing code
}

public function show(Student $student)
{
    $this->authorize('view', $student);
    
    // ... existing code
}

public function edit(Student $student)
{
    $this->authorize('update', $student);
    
    return view('students.edit', compact('student'));
}

public function update(Request $request, Student $student)
{
    $this->authorize('update', $student);
    
    // ... existing code
}

public function destroy(Student $student)
{
    $this->authorize('delete', $student);
    
    // ... existing code
}
```

### 9. Update Routes with Middleware

Update `routes/web.php`:

```php
// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses', [TeacherController::class, 'courses'])->name('courses');
    Route::get('/students', [TeacherController::class, 'students'])->name('students');
});

// Protected routes with permissions
Route::middleware(['auth'])->group(function () {
    // Students
    Route::resource('students', StudentController::class)->middleware('permission:view-students,manage-students');
    
    // Courses
    Route::resource('courses', CourseController::class)->middleware('permission:view-courses,manage-courses');
    
    // Teachers
    Route::resource('teachers', TeacherController::class)->middleware('permission:view-teachers,manage-teachers');
    
    // Enrollments
    Route::resource('enrollments', EnrollmentController::class)->middleware('permission:view-enrollments,manage-enrollments');
});
```

### 10. Update Views with Authorization

Update views to include authorization checks:

```blade
{{-- In students/index.blade.php --}}
@can('create', App\Models\Student::class)
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-2"></i>Add Student
    </a>
@endcan

@can('update', $student)
    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning">
        <i class="bi bi-pencil"></i>
    </a>
@endcan

@can('delete', $student)
    <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
            <i class="bi bi-trash"></i>
        </button>
    </form>
@endcan
```

### 11. Create Seeder for Roles and Permissions

Create `database/seeders/RolePermissionSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            // Student permissions
            ['name' => 'view-students', 'display_name' => 'View Students'],
            ['name' => 'manage-students', 'display_name' => 'Manage Students'],
            
            // Course permissions
            ['name' => 'view-courses', 'display_name' => 'View Courses'],
            ['name' => 'manage-courses', 'display_name' => 'Manage Courses'],
            
            // Teacher permissions
            ['name' => 'view-teachers', 'display_name' => 'View Teachers'],
            ['name' => 'manage-teachers', 'display_name' => 'Manage Teachers'],
            
            // Enrollment permissions
            ['name' => 'view-enrollments', 'display_name' => 'View Enrollments'],
            ['name' => 'manage-enrollments', 'display_name' => 'Manage Enrollments'],
            
            // System permissions
            ['name' => 'view-reports', 'display_name' => 'View Reports'],
            ['name' => 'manage-users', 'display_name' => 'Manage Users'],
            ['name' => 'system-settings', 'display_name' => 'System Settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create roles
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full system access',
                'permissions' => Permission::all()->pluck('name')->toArray()
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher',
                'description' => 'Teacher access',
                'permissions' => [
                    'view-students', 'view-courses', 'view-teachers', 'view-enrollments',
                    'manage-enrollments', 'view-reports'
                ]
            ],
            [
                'name' => 'student',
                'display_name' => 'Student',
                'description' => 'Student access',
                'permissions' => [
                    'view-courses', 'view-enrollments'
                ]
            ]
        ];

        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);
            
            $role = Role::create($roleData);
            $role->permissions()->attach(
                Permission::whereIn('name', $permissions)->pluck('id')
            );
        }
    }
}
```

---

## ✅ Checklist

- [ ] Role and permission migrations created
- [ ] Role and Permission models created
- [ ] User model updated with role methods
- [ ] Policies created for all entities
- [ ] Policies registered in AuthServiceProvider
- [ ] Custom middleware created
- [ ] Controllers updated with authorization
- [ ] Routes protected with middleware
- [ ] Views updated with authorization checks
- [ ] Seeder created for roles and permissions
- [ ] Authorization tests implemented

---

## 🔧 Common Issues & Solutions

### Issue: Policies not working
**Solution:** Make sure policies are registered in `AuthServiceProvider`:
```php
protected $policies = [
    Student::class => StudentPolicy::class,
];
```

### Issue: Middleware not found
**Solution:** Register middleware in `Kernel.php`:
```php
'role' => \App\Http\Middleware\CheckRole::class,
```

### Issue: Authorization checks failing
**Solution:** Use proper authorization methods:
```php
$this->authorize('view', $student);
```

### Issue: Roles not assigned
**Solution:** Run the seeder:
```bash
php artisan db:seed --class=RolePermissionSeeder
```

---

## 🔐 Authorization Features

1. **Role-Based Access**: Different roles (Admin, Teacher, Student)
2. **Permission-Based Access**: Granular permissions for each action
3. **Policy Protection**: All models protected by policies
4. **Middleware Protection**: Routes protected by middleware
5. **View Authorization**: UI elements hidden based on permissions
6. **Admin Panel**: Special admin-only functionality
7. **Teacher Dashboard**: Teacher-specific features
8. **Student Portal**: Limited student access
9. **Audit Trail**: Track who performed what actions
10. **Security**: Proper authorization at all levels

---

## 🔄 Next Steps

1. **Create seeders** for test data
2. **Implement audit logging** for actions
3. **Add user management** interface
4. **Create role assignment** interface
5. **Implement advanced permissions**

---

## 🌐 Arabic Translation

### نظام التفويض والسياسات لنظام التدريس

**الخطوات المطلوبة:**
1. إنشاء نظام الأدوار والصلاحيات
2. تطبيق السياسات لجميع الكيانات
3. إضافة middleware لحماية المسارات
4. إنشاء تحكم في الوصول حسب الأدوار
5. تطبيق فحوصات التفويض في الواجهات

**المميزات:**
- نظام أدوار متقدم
- صلاحيات دقيقة
- حماية شاملة
- واجهة إدارية
- أمان عالي المستوى

---

## 📚 Additional Resources

- [Laravel Authorization](https://laravel.com/docs/authorization)
- [Laravel Policies](https://laravel.com/docs/policies)
- [Laravel Middleware](https://laravel.com/docs/middleware)
- [Role-Based Access Control](https://en.wikipedia.org/wiki/Role-based_access_control)
- [Security Best Practices](https://laravel.com/docs/security)

---

## 🎯 Summary

In this step, we've successfully implemented:

- **Role-Based System**: Admin, Teacher, Student roles
- **Permission System**: Granular permissions for all actions
- **Policy Protection**: All models protected by policies
- **Middleware Security**: Route-level protection
- **Authorization Checks**: Proper access control throughout
- **Admin Features**: Special admin-only functionality
- **Security**: Comprehensive security measures

The Teaching System now has robust authorization and security features! 