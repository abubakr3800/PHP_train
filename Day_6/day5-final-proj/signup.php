<?php
$success = false;
$user = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  
  // التحقق من الصورة
  if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    $type = $_FILES['avatar']['type'];
    $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($type, $allowed)) {
      $dir = "uploads/" . date('Y-m-d') . "/";
      if (!file_exists($dir)) mkdir($dir, 0777, true);

      $fileName = time() . '_' . basename($_FILES['avatar']['name']);
      $fullPath = $dir . $fileName;
      $user = [
        'username'=>$name,
        'email'=>$email,
        'img'=>$fullPath,
        'pass'=>$pass
      ];

      move_uploaded_file($_FILES['avatar']['tmp_name'], $fullPath);
      $success = true;
    } else {
      $error = "❌ Only JPG and PNG images allowed.";
    }
  } else {
    $error = "❌ Please upload an image.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark p-4">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <?php if ($success): ?>
                    <div class="row d-flex justify-content-center">
                        <div class="card mx-0 px-0" style="width: 18rem;">
                            <img src="<?=$user['img']?>" class="card-img-top w-100" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$user['username']?></h5>
                                <p class="card-text"><?= $user['email']?></p>
                                <a href="./products.php?email=<?=$user['email']?>&password=<?=$user['pass']?>" class="btn btn-primary">Go to Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-success my-5">✅ Account Created Successfully</div>
                <?php elseif ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label>Name</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Profile Image</label>
                        <input type="file" name="avatar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-success w-100">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
