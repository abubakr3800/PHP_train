<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 1) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <span class="navbar-text text-white">
      Logged in as Admin | <?= $_SESSION['user'] ?>
    </span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-5">
  <h2>👨‍💼 Admin Panel</h2>
  <p>Welcome, <?= $_SESSION['user'] ?>! You have full access.</p>

  <div class="row">
    <div class="col-md-6">
      <a href="./students/students.php" class="btn btn-primary w-100 mb-2">Manage Students</a>
      <a href="./courses/courses.php" class="btn btn-success w-100 mb-2">Manage Courses</a>
      <a href="./enrollments/enrollments.php" class="btn btn-warning w-100 mb-2">Manage Enrollments</a>
    </div>
  </div>
</div>
</body>
</html>
