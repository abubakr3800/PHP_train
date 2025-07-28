<?php
$conn = new mysqli("localhost", "root", "", "training_system");
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role']; // user or admin
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM admin WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Email already exists.";
    } else {
        $stmt = $conn->prepare("INSERT INTO admin (name, email, pass, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $pass, $role);
        $stmt->execute();
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
      
      <select name="role" class="form-select mb-3">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
      
      <button class="btn btn-success w-100">Register</button>
      <a href="login.php" class="btn btn-link mt-2">Back to login</a>
    </form>
  </div>
</body>
</html>
