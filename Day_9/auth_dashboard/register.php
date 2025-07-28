<?php
include 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $role = 'user';
  $hashed = password_hash($pass, PASSWORD_DEFAULT);
  $sql = "INSERT INTO admin (name, email, pass, role) VALUES ('$name', '$email', '$hashed', '$role')";
  mysqli_query($conn, $sql);
  echo "<div class='alert alert-success'>Registered</div>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container mt-5'>
<form method='POST' class='card p-4 shadow-sm w-50 mx-auto'>
  <input name='name' class='form-control mb-2' placeholder='Name' required>
  <input name='email' type='email' class='form-control mb-2' placeholder='Email' required>
  <input name='password' type='password' class='form-control mb-2' placeholder='Password' required>
  <button class='btn btn-success'>Register</button>
</form>
</body>
</html>