<?php
session_start();
if (!isset($_SESSION['user'])) { 
    die("Access denied. <a href='login.php'>Login</a>");
}else {

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="upload.php">Upload Product</a></li>
        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
        <li class="nav-item"><a class="nav-link" href="view_uploads.php">Image Log Table</a></li>
        <li class="nav-item"><a class="nav-link" href="view_logins.php">Login Log Table</a></li>
      </ul>
      <span class="navbar-text text-white">Welcome <?= $_SESSION['user'] ?> | <a class="btn btn-sm btn-outline-light" href="logout.php">Logout</a></span>
    </div>
  </div>
</nav> -->
<?php 
    require('nav.php');
?>
<div class="container mt-5">
  <h3>Welcome to your dashboard, <?= $_SESSION['user'] ?>!</h3>
</div>
</body>
</html>
<?php
}
?>