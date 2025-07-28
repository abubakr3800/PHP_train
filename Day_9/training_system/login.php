<?php
session_start();
include './db/db.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // $select = "SELECT * FROM admin WHERE email = '$email'";
    // $result = mysqli_query($conn , $select);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['login_time'] = date("Y-m-d H:i:s");

            $ip = $_SERVER['REMOTE_ADDR'];
            $logStmt = mysqli_prepare($conn, "INSERT INTO login_logs (user_email, ip_address) VALUES (?, ?)");
            mysqli_stmt_bind_param($logStmt, "ss", $email, $ip);
            mysqli_stmt_execute($logStmt);

            $logText = "[" . date("Y-m-d H:i:s") . "] LOGIN: $email from IP: $ip" . PHP_EOL;
            file_put_contents('logs/login.log', $logText, FILE_APPEND);


            header("Location: index.php");
            exit;
        } else {
            $error = "Wrong password.";

            $ip = $_SERVER['REMOTE_ADDR'];
            $failText = "[" . date("Y-m-d H:i:s") . "] FAILED: Wrong password for ($email) from IP: $ip" . PHP_EOL;
            file_put_contents('logs/failed_login.log', $failText, FILE_APPEND);
        }
    } else {
        $error = "Email not found.";
        // $error = "Email not found.";

        $ip = $_SERVER['REMOTE_ADDR'];
        $failText = "[" . date("Y-m-d H:i:s") . "] FAILED: Email not found ($email) from IP: $ip" . PHP_EOL;
        file_put_contents('logs/failed_login.log', $failText, FILE_APPEND);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">Login</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
      <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
      <input name="pass" type="password" class="form-control mb-3" placeholder="Password" required>
      <button class="btn btn-primary w-100">Login</button>
      <a href="register.php" class="btn btn-link mt-2">New user? Register</a>
    </form>
  </div>
</body>
</html>
