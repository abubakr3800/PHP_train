<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $file = $_FILES['avatar'];
  $allowed = ['image/jpeg', 'image/png'];

  if (in_array($file['type'], $allowed) && $file['error'] == 0) {
    move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
    echo "<div class='alert alert-success'>تم الرفع بنجاح!</div>";
    echo "<img src='uploads/{$file['name']}' class='img-thumbnail mt-3' width='200'>";
  } else {
    echo "<div class='alert alert-danger'>الملف غير مسموح به أو به خطأ.</div>";
  }
}
?>
<form method="post" enctype="multipart/form-data" class="p-3">
  <label class="form-label">اختر صورة:</label>
  <input type="file" name="avatar" class="form-control mb-2" required>
  <button class="btn btn-primary">رفع</button>
</form>
