# Simple Student Management System - Day 1 Project

A simplified PHP application demonstrating fundamental PHP concepts learned in Day 1. This is a basic student management system with minimal dependencies.

## 🎯 Project Overview

This project demonstrates a simple student management system built using PHP fundamentals including:
- Session management
- Form handling and validation
- Individual variables (no arrays)
- Functions and variable scope
- Conditional statements
- HTML/PHP integration
- Bootstrap styling (minimal)

## 📁 Project Structure

```
student_day_1_task/
├── index.php          # Main dashboard
├── login.php          # Login page
├── students.php       # Students listing with search
├── logout.php         # Logout functionality
├── task.txt           # Task assignments
└── README.md          # This file
```

## 🚀 Features Implemented

### ✅ Completed Features

1. **Simple Authentication System**
   - Login with email/password
   - Session management
   - Logout functionality
   - Basic form validation

2. **Dashboard (index.php)**
   - Welcome page for logged-in users
   - Simple student information display
   - Basic statistics
   - Navigation buttons

3. **Students Listing (students.php)**
   - Display all students in a table
   - Simple search functionality
   - Basic statistics
   - Clean, minimal design

4. **Login System (login.php)**
   - Simple login form
   - Form validation
   - Error handling
   - Demo accounts provided

## 👥 Demo Accounts

Use any of these accounts to log in:

| Email | Password | Student ID |
|-------|----------|------------|
| john.doe@student.com | 123 | 1 |
| sarah.wilson@student.com | 123 | 2 |
| mike.johnson@student.com | 123 | 3 |

## 🛠️ PHP Concepts Demonstrated

### 1. **Session Management**
```php
session_start();
$_SESSION['student_id'] = $studentId;
session_destroy();
```

### 2. **Individual Variables (No Arrays)**
```php
$user_one_name = 'John Doe';
$user_one_course = 'Computer Science';
$user_one_gpa = 3.8;

$user_two_name = 'Sarah Wilson';
$user_two_course = 'Web Development';
$user_two_gpa = 3.9;
```

### 3. **Form Handling and Validation**
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    }
}
```

### 4. **Conditional Statements**
```php
if ($email === 'john.doe@student.com' && $password === '123') {
    // Login successful
} else {
    // Login failed
}
```

### 5. **Simple Loops and Iteration**
```php
// Manual iteration through individual variables
if ($search_term && strpos(strtolower($user_one_name), strtolower($search_term)) !== false) {
    // Display user_one
}
```

### 6. **String Manipulation and HTML Integration**
```php
echo htmlspecialchars($user_one_name);
echo "<span class='badge'>$user_one_gpa</span>";
```

## 🎨 Design Features

- **Simple Bootstrap Design**
- **Clean, minimal layout**
- **Basic color scheme**
- **Mobile-friendly**
- **No complex CSS or JavaScript**

## 🔧 Technical Implementation

### Security Features
- Session-based authentication
- Input sanitization with `htmlspecialchars()`
- Basic form validation
- Secure logout

### Data Management
- Individual variables (no arrays)
- Basic search functionality
- Simple statistics calculation
- Minimal data processing

### User Experience
- Simple navigation
- Basic search
- Clean design
- Error handling

## 🚀 How to Run

1. **Start your XAMPP server**
2. **Navigate to the project folder**
3. **Open `login.php` in your browser**
4. **Use any demo account to log in**
5. **Explore the different features**

## 📊 Learning Objectives Achieved

✅ **Basic PHP Syntax** - Variables, data types, operators  
✅ **Functions and Scope** - Simple functions  
✅ **Individual Variables** - No arrays, simple variables  
✅ **Conditional Statements** - if/else statements  
✅ **HTML and PHP Integration** - Embedded PHP  
✅ **Session Management** - Login/logout, session variables  
✅ **Form Handling** - GET/POST, validation  
✅ **Bootstrap Integration** - Basic responsive design  

## 🔮 Future Enhancements

- Add more pages (profile, courses, grades)
- Database integration
- More complex search filters
- Student registration
- Admin functionality

## 📝 Code Quality Features

- **Simple, readable code**
- **Basic comments**
- **Consistent structure**
- **Error handling**
- **Security considerations**
- **Clean design**
- **User-friendly interface**

This simplified project serves as a basic demonstration of PHP Day 1 concepts without overwhelming complexity. The use of individual variables instead of arrays makes it more beginner-friendly and easier to understand. 