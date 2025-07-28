<?php 
  $goto = (pathinfo(getcwd())["basename"] == "training_system" ? '' : '../');
  // __FILE__;
  // if(session_status() !== PHP_SESSION_ACTIVE) session_start();
  $name = $_SESSION['user'];
  $email = $_SESSION['email'];
  $role = $_SESSION['role'];
  if (!isset($_SESSION['user'])) {
    $pass = $goto . 'login.php';
    header("Location: $goto ");
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= $goto ?>index.php">
      <!-- Training EX -->
      <span class="text-white me-3">Welcome, <?= $name ?> (<?= $role ? 'Admin' : 'User' ?>)</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>students/students.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>courses/courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>enrollments/enrollments.php">Enrollments</a></li>
        <li class="nav-item"><a class=" btn-outline-secondary btn" href="<?= $goto ?>logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
