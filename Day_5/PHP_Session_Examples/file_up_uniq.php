<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $file = $_FILES['pic'];
  $allowed = ['image/jpeg', 'image/png'];
  $max_size = 2 * 1024 * 1024; // 2MB
  $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
  $allowedExt = ["jpg" , "png" , "jpeg"];
  
  if ( in_array($ext , $allowedExt) && in_array($file['type'], $allowed) && $file['size'] <= $max_size && $file['error'] == 0) {

    $new_name = uniqid('img_' , true) . '.' . $ext;
    move_uploaded_file( $file['tmp_name'], "uploads/$new_name");

    echo "<div class='alert alert-success'>تم الرفع بنجاح!</div>";
    echo "<img src='uploads/$new_name' class='img-thumbnail mt-3' width='200'>";
  } else {
    echo "<div class='alert alert-danger'>الملف غير مسموح به أو حجمه كبير.</div>";
  }
}
?>

<form method="post" enctype="multipart/form-data" class="p-3">
  <input type="file" name="pic" class="form-control mb-2" required>
  <button class="btn btn-primary">رفع</button>
</form>
