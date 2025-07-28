<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <span class="navbar-text text-white">
      Logged in as User | <?= $_SESSION['user'] ?>
    </span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-5">
  <h2>🎓 User Panel</h2>
  <p>Welcome, <?= $_SESSION['user'] ?>! You can view your data below.</p>

  <div class="card shadow-sm mt-4">
    <div class="card-body">
      <h5 class="card-title">Available Courses</h5>
      <p class="card-text">To enroll in a course, please contact admin.</p>
      <a href="./courses/courses.php" class="btn btn-success">View Courses</a>
    </div>
  </div>
</div>
</body>
</html>
