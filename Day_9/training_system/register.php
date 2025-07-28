<?php
include './db/db.php';
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $check = mysqli_prepare($conn, "SELECT id FROM admin WHERE email = ?");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $error = "Email already exists.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO admin (name, email, pass) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $pass);
        mysqli_stmt_execute($stmt);
        $success = "User registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="text-center mb-4">Register</h2>
    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
      <input name="name" class="form-control mb-3" placeholder="Full Name" required>
      <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
      <input name="pass" type="password" class="form-control mb-3" placeholder="Password" required>
      
      <!-- <select name="role" class="form-select mb-3">
        <option value="0">User</option>
        <option value="1">Admin</option>
      </select> -->
      
      <button class="btn btn-success w-100">Register</button>
      <a href="login.php" class="btn btn-link mt-2">Back to login</a>
    </form>
  </div>
</body>
</html>
