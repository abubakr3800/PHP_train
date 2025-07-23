<?php 
  $goto = (pathinfo(getcwd())["basename"] == "training_system" ? './' : '../');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= $goto ?>index.php">
      Training EX
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>students/students.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>courses/courses.php">Courses</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $goto ?>enrollments/enrollments.php">Enrollments</a></li>
      </ul>
    </div>
  </div>
</nav>
