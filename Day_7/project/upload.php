<?php
session_start();

// 🔐 حماية الدومين
if (strpos($_SERVER['HTTP_HOST'], 'localhost') === false) {
  die("<div style='padding:20px;font-family:sans-serif;color:red;'>Access Denied: Use domain only</div>");
}

if (!isset($_SESSION['user'])) { 
    die("Access denied. <a href='login.php'>Login</a>");
}else {


$user = $_SESSION['user'];
$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
  $type = $_POST['type'];
  $folder = "uploads/" . date("Y-m-d") . "/";
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $imageName = time() . '_' . basename($_FILES['image']['name']);
  $target = $folder . $imageName;
  $mime = $_FILES['image']['type'];
  $allowed = ['image/jpeg', 'image/png'];

  if (in_array($mime, $allowed)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    file_put_contents("logs/uploads.log", date('Y-m-d H:i:s') . " | $user | $type | $target | $mime\n", FILE_APPEND);
    $success = "Image uploaded.";
  } else {
    $error = "Invalid file type.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Upload</title>
</head>
<body class="">
    <?php 
    require('nav.php');
    ?>

    <div class="container mt-5">
        <h2>Upload Image</h2>
        <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST" enctype="multipart/form-data" class="row g-3">
          <div class="col-md-4"><input type="file" name="image" class="form-control" accept="image/*" required></div>
          <div class="col-md-4">
            <select name="type" class="form-select" required>
              <option value="">Choose type</option>
              <option value="avatar">Avatar</option>
              <option value="product">Product</option>
            </select>
          </div>
          <div class="col-md-4"><button class="btn btn-primary">Upload</button></div>
        </form>
        <p class="mt-3"><a href='gallery.php'>View Gallery</a> | <a href='logout.php'>Logout</a></p>
    </div>
</body>
</html>
<?php
}
?>