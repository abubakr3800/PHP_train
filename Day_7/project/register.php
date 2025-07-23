<?php
session_start();
$usersFile = 'users.db.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploadDir = 'uploads/profiles/';
  if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

  $imageName = time() . '_' . basename($_FILES['avatar']['name']);
  $imagePath = $uploadDir . $imageName;

  $allowed = ['image/jpeg', 'image/png'];
  if (in_array($_FILES['avatar']['type'], $allowed)) {
    move_uploaded_file($_FILES['avatar']['tmp_name'], $imagePath);
  } else {
    die("<div class='alert alert-danger'>Invalid image type</div>");
  }

  $newUser = [
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'email'    => $_POST['email'],
    'gender'   => $_POST['gender'],
    'job'      => $_POST['job'],
    'avatar'   => $imagePath
  ];

  $users[] = $newUser;
  file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
  $success = "User registered. You can now login.";
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Register</title>
</head>
<body class="container mt-5">

  <h2>Register</h2>
  <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
  <form method="POST" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-4"><input name="username" class="form-control" placeholder="Username" required></div>
    <div class="col-md-4"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
    <div class="col-md-4"><input name="email" type="email" class="form-control" placeholder="Email" required></div>
    <div class="col-md-4">
      <select name="gender" class="form-select" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
    <div class="col-md-4">
      <select name="job" class="form-select" required>
        <option value="">Select Job</option>
        <option>Developer</option>
        <option>Designer</option>
        <option>Manager</option>
      </select>
    </div>
    <div class="col-md-4"><input type="file" name="avatar" class="form-control" required></div>
    <div class="col-md-12"><button class="btn btn-success">Register</button></div>
  </form>
  <p class="mt-3">Already have account? <a href="login.php">Login</a></p>
</body>
</html>
