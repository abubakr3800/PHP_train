<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container mt-5'>
<h3 class='mb-4'>Welcome <?= $_SESSION['user'] ?> (<?= $_SESSION['role'] ?>)</h3>
<div class='row'>
  <div class='col-md-4'>
    <div class='card text-bg-primary mb-3'>
      <div class='card-body'>
        <h5 class='card-title'>Students</h5>
        <?php
          $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM students"));
          echo "<p class='card-text'>Total: {$count['total']}</p>";
        ?>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='card text-bg-success mb-3'>
      <div class='card-body'>
        <h5 class='card-title'>Courses</h5>
        <?php
          $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM courses"));
          echo "<p class='card-text'>Total: {$count['total']}</p>";
        ?>
      </div>
    </div>
  </div>
  <div class='col-md-4'>
    <div class='card text-bg-warning mb-3'>
      <div class='card-body'>
        <h5 class='card-title'>Enrollments</h5>
        <?php
          $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM enrollments"));
          echo "<p class='card-text'>Total: {$count['total']}</p>";
        ?>
      </div>
    </div>
  </div>
</div>
<a href='logout.php' class='btn btn-danger'>Logout</a>
</body>
</html>