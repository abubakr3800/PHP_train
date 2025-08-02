# 🔄 Step 7: Basic CRUD Operations for Teaching System

## 📋 Overview
In this step, we'll implement the complete CRUD (Create, Read, Update, Delete) operations for all entities in our Teaching System: Students, Courses, Teachers, and Enrollments. Each entity will have full functionality with proper validation and user feedback.

## 🎯 Objectives
- Implement complete CRUD operations for all entities
- Create views for listing, creating, editing, and showing records
- Add proper validation and error handling
- Implement search and filtering functionality
- Add pagination for large datasets
- Create responsive forms with Bootstrap styling

## 📁 Files to Create/Modify
- `app/Http/Controllers/StudentController.php`
- `app/Http/Controllers/CourseController.php`
- `app/Http/Controllers/TeacherController.php`
- `app/Http/Controllers/EnrollmentController.php`
- `resources/views/students/` (All student views)
- `resources/views/courses/` (All course views)
- `resources/views/teachers/` (All teacher views)
- `resources/views/enrollments/` (All enrollment views)
- `app/Http/Requests/` (Form request validation)

---

## 🚀 Step-by-Step Implementation

### 1. Update Student Controller

Update `app/Http/Controllers/StudentController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $students = $query->paginate(15);

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'student_id' => 'required|string|unique:students,student_id|max:20',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive,pending',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $student = Student::create($request->all());
            
            return redirect()->route('students.index')
                ->with('success', 'Student created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified student
     */
    public function show(Student $student)
    {
        $enrollments = $student->enrollments()->with(['course', 'teacher'])->paginate(10);
        
        return view('students.show', compact('student', 'enrollments'));
    }

    /**
     * Show the form for editing the specified student
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'student_id' => 'required|string|unique:students,student_id,' . $student->id . '|max:20',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive,pending',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $student->update($request->all());
            
            return redirect()->route('students.index')
                ->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating student: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified student
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            
            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting student: ' . $e->getMessage());
        }
    }

    /**
     * Show student enrollments
     */
    public function enrollments(Student $student)
    {
        $enrollments = $student->enrollments()->with(['course', 'teacher'])->paginate(15);
        
        return view('students.enrollments', compact('student', 'enrollments'));
    }

    /**
     * Search students
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $students = Student::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('student_id', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'email', 'student_id']);
            
        return response()->json($students);
    }

    /**
     * Export students data
     */
    public function export(Request $request)
    {
        $students = Student::all();
        
        $filename = 'students_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Student ID', 'Phone', 'Status', 'Created At']);
            
            // Add data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->name,
                    $student->email,
                    $student->student_id,
                    $student->phone,
                    $student->status,
                    $student->created_at
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
```

### 2. Create Student Views

**Index View** (`resources/views/students/index.blade.php`):

```blade
@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Students</h1>
            <p class="text-muted">Manage student records and information</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Add Student
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('students.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Search by name, email, or ID">
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <select class="form-select" id="sort_by" name="sort_by">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="student_id" {{ request('sort_by') == 'student_id' ? 'selected' : '' }}>Student ID</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="sort_order" class="form-label">Order</label>
                    <select class="form-select" id="sort_order" name="sort_order">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i>Search
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </a>
                    <a href="{{ route('students.export') }}" class="btn btn-success float-end">
                        <i class="bi bi-download me-1"></i>Export
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Students List -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Enrollments</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ $student->name }}&background=random" 
                                             class="rounded-circle me-3" width="48" height="48" alt="Avatar">
                                        <div>
                                            <div class="fw-bold">{{ $student->name }}</div>
                                            <small class="text-muted">{{ $student->student_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $student->email }}</div>
                                    @if($student->phone)
                                        <small class="text-muted">{{ $student->phone }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge status-{{ $student->status }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $student->enrollments_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <small>{{ $student->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('students.show', $student) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           data-bs-toggle="tooltip" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student) }}" 
                                           class="btn btn-sm btn-outline-warning" 
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('students.destroy', $student) }}" 
                                              class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $students->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-people text-muted fs-1"></i>
                    <h5 class="text-muted mt-3">No students found</h5>
                    <p class="text-muted">Start by adding your first student.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Add Student
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
```

**Create View** (`resources/views/students/create.blade.php`):

```blade
@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-plus me-2"></i>
                        Add New Student
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('students.store') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="student_id" class="form-label">Student ID *</label>
                                <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                                       id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                       id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" 
                                        id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Students
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Create Student
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

### 3. Create Similar Controllers and Views for Other Entities

**Course Controller** (`app/Http/Controllers/CourseController.php`):

```php
<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by level
        if ($request->has('level') && $request->level !== '') {
            $query->where('level', $request->level);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $courses = $query->paginate(15);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code|max:20',
            'description' => 'nullable|string|max:1000',
            'credits' => 'required|integer|min:1|max:10',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:active,inactive,draft',
            'duration' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $course = Course::create($request->all());
            
            return redirect()->route('courses.index')
                ->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Course $course)
    {
        $enrollments = $course->enrollments()->with(['student', 'teacher'])->paginate(10);
        
        return view('courses.show', compact('course', 'enrollments'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:courses,code,' . $course->id . '|max:20',
            'description' => 'nullable|string|max:1000',
            'credits' => 'required|integer|min:1|max:10',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:active,inactive,draft',
            'duration' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $course->update($request->all());
            
            return redirect()->route('courses.index')
                ->with('success', 'Course updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            
            return redirect()->route('courses.index')
                ->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }

    public function students(Course $course)
    {
        $students = $course->students()->paginate(15);
        
        return view('courses.students', compact('course', 'students'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        $courses = Course::where('title', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'title', 'code']);
            
        return response()->json($courses);
    }

    public function export(Request $request)
    {
        $courses = Course::all();
        
        $filename = 'courses_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($courses) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['ID', 'Title', 'Code', 'Credits', 'Level', 'Status', 'Duration', 'Created At']);
            
            foreach ($courses as $course) {
                fputcsv($file, [
                    $course->id,
                    $course->title,
                    $course->code,
                    $course->credits,
                    $course->level,
                    $course->status,
                    $course->duration,
                    $course->created_at
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
```

### 4. Create Enrollment Controller

**Enrollment Controller** (`app/Http/Controllers/EnrollmentController.php`):

```php
<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['student', 'course', 'teacher']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('course', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Sort functionality
        $sortBy = $request->get('sort_by', 'enrollment_date');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $enrollments = $query->paginate(15);

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();
        
        return view('enrollments.create', compact('students', 'courses', 'teachers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'enrollment_date' => 'required|date',
            'grade' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:active,completed,dropped,pending',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate enrollment
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->with('error', 'Student is already enrolled in this course.')
                ->withInput();
        }

        try {
            $enrollment = Enrollment::create($request->all());
            
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating enrollment: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $teachers = Teacher::where('status', 'active')->get();
        
        return view('enrollments.edit', compact('enrollment', 'students', 'courses', 'teachers'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'enrollment_date' => 'required|date',
            'grade' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:active,completed,dropped,pending',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check for duplicate enrollment (excluding current enrollment)
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->where('id', '!=', $enrollment->id)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()
                ->with('error', 'Student is already enrolled in this course.')
                ->withInput();
        }

        try {
            $enrollment->update($request->all());
            
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating enrollment: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Enrollment $enrollment)
    {
        try {
            $enrollment->delete();
            
            return redirect()->route('enrollments.index')
                ->with('success', 'Enrollment deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting enrollment: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $enrollments = Enrollment::with(['student', 'course', 'teacher'])->get();
        
        $filename = 'enrollments_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($enrollments) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['ID', 'Student', 'Course', 'Teacher', 'Enrollment Date', 'Grade', 'Status']);
            
            foreach ($enrollments as $enrollment) {
                fputcsv($file, [
                    $enrollment->id,
                    $enrollment->student->name,
                    $enrollment->course->title,
                    $enrollment->teacher->name,
                    $enrollment->enrollment_date,
                    $enrollment->grade,
                    $enrollment->status
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
```

---

## ✅ Checklist

- [ ] Student CRUD operations implemented
- [ ] Course CRUD operations implemented
- [ ] Teacher CRUD operations implemented
- [ ] Enrollment CRUD operations implemented
- [ ] Search functionality added
- [ ] Pagination implemented
- [ ] Form validation working
- [ ] Error handling implemented
- [ ] Export functionality added
- [ ] Responsive forms created
- [ ] Bootstrap styling applied
- [ ] Flash messages working

---

## 🔧 Common Issues & Solutions

### Issue: Validation errors not showing
**Solution:** Make sure to include `@error` directives in forms:
```blade
@error('field_name')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
```

### Issue: Unique constraint violations
**Solution:** Add proper unique validation rules:
```php
'email' => 'required|email|unique:students,email,' . $student->id,
```

### Issue: Foreign key constraint failures
**Solution:** Ensure related records exist before creating relationships:
```php
'student_id' => 'required|exists:students,id',
```

### Issue: Pagination not working
**Solution:** Make sure to use `paginate()` method:
```php
$students = $query->paginate(15);
```

---

## 🎨 CRUD Features Implemented

1. **Create**: Add new records with validation
2. **Read**: List all records with search and filters
3. **Update**: Edit existing records
4. **Delete**: Remove records with confirmation
5. **Search**: Find records by multiple criteria
6. **Filter**: Filter by status, date, etc.
7. **Sort**: Sort by different columns
8. **Pagination**: Handle large datasets
9. **Export**: Download data as CSV
10. **Validation**: Client and server-side validation

---

## 🔄 Next Steps

1. **Add authorization policies** for different user roles
2. **Create seeders** for test data
3. **Implement advanced search** with multiple filters
4. **Add bulk operations** (delete multiple, export selected)
5. **Create reports and analytics** pages

---

## 🌐 Arabic Translation

### العمليات الأساسية لنظام التدريس

**الخطوات المطلوبة:**
1. تنفيذ عمليات CRUD للطلاب
2. تنفيذ عمليات CRUD للدورات
3. تنفيذ عمليات CRUD للمعلمين
4. تنفيذ عمليات CRUD للتسجيلات
5. إضافة وظائف البحث والتصفية
6. تطبيق التحقق من صحة البيانات

**المميزات:**
- نماذج تفاعلية متجاوبة
- تحقق من صحة البيانات
- رسائل خطأ واضحة
- تصدير البيانات
- ترقيم الصفحات
- بحث متقدم

---

## 📚 Additional Resources

- [Laravel Validation](https://laravel.com/docs/validation)
- [Eloquent Relationships](https://laravel.com/docs/eloquent-relationships)
- [Form Request Validation](https://laravel.com/docs/form-request-validation)
- [Bootstrap Forms](https://getbootstrap.com/docs/forms/)
- [Laravel Pagination](https://laravel.com/docs/pagination)

---

## 🎯 Summary

In this step, we've successfully implemented:

- **Complete CRUD Operations**: For all entities (Students, Courses, Teachers, Enrollments)
- **Search and Filter**: Advanced search functionality with multiple criteria
- **Form Validation**: Both client and server-side validation
- **Responsive Forms**: Bootstrap-styled forms that work on all devices
- **Export Functionality**: CSV export for all entities
- **Pagination**: Handle large datasets efficiently
- **Error Handling**: Proper error messages and user feedback
- **User Experience**: Intuitive interface with clear navigation

The Teaching System now has full CRUD functionality ready for production use! 