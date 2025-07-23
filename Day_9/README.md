# ✅ Day 9 – Authentication & Sessions in PHP (6 Hours)

## 🎯 Objectives:

- Review how PHP sessions work
- Build a full login/logout system
- Secure user passwords with hashing
- Create user roles (admin/user)
- Final project: Secure Login Panel
- Discuss SQL Injection protection

---

## 🔁 1. Sessions Recap (With Bootstrap)

### ❓ Example 1 – What is a session?

**Question:** What is a session in PHP?\
**Answer:** A session is a way to store data across multiple pages for an individual user. PHP stores session data on the server using a unique session ID stored in a cookie.

**💬 شرح للمدرب:** السيشن شبه كارت تعريف بيتخزن عند الزبون (في الكوكيز) وجواه رقم بيحدد ملف على السيرفر فيه بيانات الجلسة، زي اسم المستخدم، نوعه، أو حالة تسجيل دخوله.

**Example Code:**

```php
session_start();
$_SESSION['username'] = 'ahmed';
echo "Welcome, " . $_SESSION['username'];
```

### ❓ Example 2 – Destroy a session

**Question:** How do you destroy a session?\
**Answer:**

```php
session_start();
session_unset();
session_destroy();
```

This clears all session data (used in logout).

**💬 شرح للمدرب:** لما يعمل المستخدم تسجيل خروج، بنمسح السيشن بالكامل علشان نضمن إنه مش هيقدر يرجع للوحة التحكم من غير تسجيل دخول تاني.

### 🧪 Task:

- Create a page that starts a session.
- Store a username.
- Display a Bootstrap alert with username.
- Add a logout button that destroys the session and redirects to login.

---

## 🔐 2. Login & Logout Implementation (With Bootstrap)

### ❓ Example 1 – Simple login logic (with hardcoded data)

```php
$users = ['admin' => '1234', 'user' => 'abcd'];
if ($_POST['username'] && $_POST['password']) {
  if ($users[$_POST['username']] == $_POST['password']) {
    $_SESSION['user'] = $_POST['username'];
    header('Location: dashboard.php');
  } else {
    $error = "Invalid credentials";
  }
}
```

**💬 شرح للمدرب:** في المثال دا بنجرب تسجيل دخول بدون قاعدة بيانات، بنستخدم مصفوفة فيها بيانات جاهزة للمستخدمين، علشان نوضح المفهوم.

### ❓ Example 2 – Login form with Bootstrap

```html
<form method="POST" class="card p-4 shadow-sm w-50 mx-auto mt-5">
  <input name="username" class="form-control mb-2" placeholder="Username">
  <input type="password" name="password" class="form-control mb-2" placeholder="Password">
  <button class="btn btn-primary">Login</button>
</form>
```

### 🧪 Task:

- Build full login/logout system using session
- Store login time in `$_SESSION['login_time']`
- Use Bootstrap alerts to confirm login and logout

---

## 🔑 3. Hashing Passwords

### ❓ Example 1 – Hash password before saving in DB

```php
$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
```

**💬 شرح للمدرب:** لما نستخدم `password_hash` بنحمي الباسورد من السرقة حتى لو حد اخترق قاعدة البيانات، لأنه مش هيعرف يرجع الباسورد الأصلي.

### ❓ Example 2 – Verify password during login

```php
if (password_verify($_POST['password'], $user['password'])) {
  $_SESSION['user'] = $user['name'];
}
```

### 🧪 Task:

- Create `register.php` page
- Accept name, email, and password
- Hash password and insert into MySQL
- Login page uses `password_verify()`
- Use Bootstrap to style the form and messages

---

## 👤 4. User Roles (admin/user)

### ❓ Example 1 – Add a role column in users table

```sql
ALTER TABLE users ADD role VARCHAR(20) DEFAULT 'user';
```

**💬 شرح للمدرب:** بنضيف عمود الدور في جدول المستخدمين علشان نميز بين المشرف والمستخدم العادي، وده هيساعدنا نخصص الصلاحيات.

```php
if ($_SESSION['role'] == 'admin') {
  echo "<a href='admin.php'>Admin Panel</a>";
}
```

### ❓ Example 2 – Show/hide content based on role

```php
if ($_SESSION['role'] == 'admin') {
  // Show admin features
} else {
  // Show user view only
}
```

### 🧪 Task:

- Create 2 sample users (admin, user)
- After login, show different dashboard content for each role
- Use Bootstrap cards for styling content blocks

---

## 🛡️ 5. SQL Injection – Beginner Explanation + Examples

### ✅ What is SQL Injection?

SQL Injection occurs when attackers insert malicious SQL into your query via input fields.

### ❓ Example of Vulnerable Code:

```php
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
```

**💬 شرح للمدرب:** لو المستخدم كتب `' OR 1=1 --` هيقدر يدخل من غير ما يعرف الباسورد! دا اسمه هجوم SQL Injection، وده خطر جدًا على قاعدة البيانات.

### ✅ Secure Version – Use Prepared Statements

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
```

**💬 شرح للمدرب:** `prepare()` بتفصل الكود عن البيانات، يعني حتى لو المستخدم دخل جملة SQL خبيثة، هتتعامل كأنها نص عادي مش كود.

### 🧪 Task:

- عمل فورمين لتسجيل دخول:
  1. vulnerable (raw SQL)
  2. secure (prepared statements)
- اطلب من الطلاب يجربوا `' OR 1=1 --` ويشوفوا الفرق

---

## 🧩 Final Project – Secure Login Panel

### Requirements:

- Register form (Bootstrap)
- Login form + session
- Password hashing
- User roles with different dashboard UI
- Logout link
- Protect all pages with session checks

### Optional Bonus:

- Log IP and login time
- Store login logs in database or text file

---

## ✅ Outcomes By End of Day 9:

- Students understand how to build a login system
- Know how to hash and verify passwords
- Can control user access by roles
- Understand security basics like SQL injection prevention

---

