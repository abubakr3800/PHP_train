<?php include './db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <?php include './navbar.php'; ?>
  <div class="container mt-4">
    <div class="row d-flex justify-conent-center">

      <!-- Students Card -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Students</h5>
            <?php
              $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM students"));
              echo "<p class='card-text'>Total courses: <strong>{$count['total']}</strong></p>";
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
    
  </div>
</body>
</html>
