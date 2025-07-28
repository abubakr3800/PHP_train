<?php
include 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $result = mysqli_query($conn, "SELECT * FROM admin WHERE email = '$email'");
  $user = mysqli_fetch_assoc($result);
  if ($user && password_verify($pass, $user['pass'])) {
    $_SESSION['user'] = $user['name'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['login_time'] = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    mysqli_query($conn, "INSERT INTO login_logs (user_email, ip_address) VALUES ('$email', '$ip')");
    file_put_contents('logs/login.log', "[".date("Y-m-d H:i:s")."] LOGIN: $email from $ip\n", FILE_APPEND);
    header("Location: dashboard.php");
    exit();
  } else {
    echo "<div class='alert alert-danger'>Login failed</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container mt-5'>
<form method='POST' class='card p-4 shadow-sm w-50 mx-auto'>
  <input name='email' type='email' class='form-control mb-2' placeholder='Email'>
  <input name='password' type='password' class='form-control mb-2' placeholder='Password'>
  <button class='btn btn-primary'>Login</button>
</form>
</body>
</html>