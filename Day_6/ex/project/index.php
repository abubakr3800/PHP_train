<?php
session_start();

$users = [
  ['username' => 'admin', 'password' => '1234'],
  ['username' => 'ahmed', 'password' => '5678']
];

$_SESSION['allowed_users'] = array_column($users, 'username');

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $found = false;

  foreach ($users as $u) {
    if ($u['username'] === $user && $u['password'] === $pass) {
      $_SESSION['user'] = $user;
      $found = true;
      break;
    }
  }

  $status = $found ? "SUCCESS" : "FAIL";
  $log = date('Y-m-d H:i:s') . " | $user | $status\n";
   
//   if (!file_exists("logs/login.log")) mkdir("logs/login.log", 0777, true);
//   file_put_contents("logs/login.log", $log, FILE_APPEND);

    if (!file_exists("logs")) mkdir("logs", 0777, true); // تأكد من المجلد
    file_put_contents("logs/login.log", $log, FILE_APPEND);

}

// Handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
  $user = $_SESSION['user'] ?? 'guest';
  $type = $_POST['type'];
  $folder = "uploads/" . date("Y-m-d") . "/";
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $imageName = time() . '_' . basename($_FILES['image']['name']);
  $target = $folder . $imageName;
  $mime = $_FILES['image']['type'];
  $allowed = ['image/jpeg', 'image/png', 'image/jpg'];

  if (in_array($mime, $allowed)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $log = date('Y-m-d H:i:s') . " | $user | $type | $target | $mime\n";
    file_put_contents("logs/uploads.log", $log, FILE_APPEND);
    $success = "✅ Image uploaded successfully.";
  } else {
    $error = "❌ Invalid file type.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>File Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

  <h2 class="mb-4">🛡️ File Manager Dashboard</h2>

  <!-- Login -->
  <div class="card mb-4">
    <div class="card-header bg-dark text-white">Login</div>
    <div class="card-body">
      <form method="POST" class="row g-3">
        <div class="col-md-5">
          <input name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="col-md-5">
          <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-md-2">
          <button name="login" class="btn btn-primary w-100">Login</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Upload -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">Upload Image</div>
    <div class="card-body">
      <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
      <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
      <form method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
          <input type="file" name="image" class="form-control" required accept="image/*">
        </div>
        <div class="col-md-4">
          <select name="type" class="form-select" required>
            <option value="">Choose type</option>
            <option value="avatar">Avatar</option>
            <option value="product">Product</option>
          </select>
        </div>
        <div class="col-md-2">
          <button class="btn btn-success w-100">Upload</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Gallery -->
  <h5 class="mb-3">Uploaded Images (<?= date('Y-m-d') ?>)</h5>
  <div class="row">
    <?php
      $images = glob("uploads/" . date("Y-m-d") . "/*.{jpg,jpeg,png}", GLOB_BRACE);
      foreach ($images as $img): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card shadow">
            <img src="<?= $img ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
            <div class="card-body text-center">
              <code><?= basename($img) ?></code>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
  </div>

</div>
</body>
</html>
