<?php
session_start();
$conn = new mysqli("localhost", "root", "", "training_system");
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['user'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Wrong password.";
        }
    } else {
        $error = "Email not found.";
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
