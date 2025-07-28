<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}
include './db/db.php';

$name = $_SESSION['user'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <?php include './navbar.php'; ?>

  <!-- Content -->
  <div class="container mt-4">
    <h2 class="mb-4">
      Dashboard Overview
      <?php if ($role == 1): ?>
        <a href="admin.php" class="btn btn-dark">Go to Admin Panel</a>
        <a href="logs.php" class="btn btn-outline-secondary ">View Login Logs</a>
        <a href="failed_logs.php" class="btn btn-outline-danger ">View Failed Login Attempts</a>
      <?php else: ?>
        <a href="user.php" class="btn btn-secondary">User Dashboard</a>
      <?php endif; ?>
    </h2>

    <div class="row d-flex justify-content-center">

      <!-- Students Card -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Students</h5>
            <?php
              $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM students"));
              echo "<p class='card-text'>Total students: <strong>{$count['total']}</strong></p>";
            ?>
            <a href="./students/students.php" class="btn btn-primary">View Students</a>
          </div>
        </div>
      </div>

      <!-- Courses Card -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Courses</h5>
            <?php
              $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses"));
              echo "<p class='card-text'>Total courses: <strong>{$count['total']}</strong></p>";
            ?>
            <a href="./courses/courses.php" class="btn btn-success">View Courses</a>
          </div>
        </div>
      </div>

      <!-- Enrollments Card -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Enrollments</h5>
            <?php
              $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM enrollments"));
              echo "<p class='card-text'>Total enrollments: <strong>{$count['total']}</strong></p>";
            ?>
            <a href="./enrollments/enrollments.php" class="btn btn-warning">View Enrollments</a>
          </div>
        </div>
      </div>

    </div>

    <!-- Optional: Admin Panel Section -->
    <?php if ($role === 'admin'): ?>
    <div class="mt-5">
      <h4>🔒 Admin Options</h4>
      <div class="row">
        <div class="col-md-6">
          <div class="card bg-light border-0 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Admin Panel</h5>
              <p class="card-text">As an admin, you have full control over the system settings and data.</p>
              <a href="admin.php" class="btn btn-dark">Go to Admin Panel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>


</body>
</html>
