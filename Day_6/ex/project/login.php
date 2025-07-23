<?php
session_start();
if (strpos($_SERVER['HTTP_HOST'], 'localhost') === false) {
  die("Access Denied: use domain only");
}
$usersFile = 'users.db.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['username'];
  $pass = $_POST['password'];

  foreach ($users as $u) {
    if ($u['username'] === $name && $u['password'] === $pass) {
      $_SESSION['user'] = $name;
      file_put_contents("logs/login.log", date('Y-m-d H:i:s') . " | $name | SUCCESS\n", FILE_APPEND);
      header("Location: dashboard.php");
      exit;
    }
  }

  file_put_contents("logs/login.log", date('Y-m-d H:i:s') . " | $name | FAIL\n", FILE_APPEND);
  $error = "Login failed";
}
?>
<!DOCTYPE html>
<html>
<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <h2 class="text-center">Login</h2>
                <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="POST" class="row g-3">
                  <div class="col-md-12"><input name="username" class="form-control" placeholder="Username" required></div>
                  <div class="col-md-12"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
                  <div class="col-md-12"><button class="btn btn-primary w-100">Login</button></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
