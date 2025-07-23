<?php
session_start();

// 🔐 حماية الدومين
if (strpos($_SERVER['HTTP_HOST'], 'localhost') === false) {
  die("<div style='padding:20px;font-family:sans-serif;color:red;'>Access Denied: Use domain only</div>");
}

if (!isset($_SESSION['user'])) die("Access denied. <a href='login.php'>Login</a>");

if (isset($_GET['delete']) && file_exists($_GET['delete'])) {
  unlink($_GET['delete']);
  header("Location: gallery.php");
}

$images = glob("uploads/" . date("Y-m-d") . "/*.{jpg,png,jpeg}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Gallery</title>
</head>
<body class="">
    <?php 
        require('nav.php');
    ?>
    <div class="container mt-5">
        <h2>Gallery</h2>
        <table class="table table-striped table-bordered">
            <thead><tr><th>Image</th><th>Name</th><th>Type</th><th>Size</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach ($images as $img): $info = pathinfo($img); ?>
            <tr>
                <td><img src="<?= $img ?>" width="60"></td>
                <td><?= $info['basename'] ?></td>
                <td><?= $info['extension'] ?></td>
                <td><?= filesize($img) ?> bytes</td>
                <td><a href="?delete=<?= $img ?>" class="btn btn-danger btn-sm">Delete</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href='upload.php'>Back to Upload</a> | <a href='logout.php'>Logout</a>
    </div>
  
</body>
</html>
