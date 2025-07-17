<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $count = count($_FILES['photos']['name']);
  $allowed = ['image/jpeg', 'image/png'];

  for ($i = 0; $i < $count; $i++) {
    $type = $_FILES['photos']['type'][$i];
    $tmp = $_FILES['photos']['tmp_name'][$i];
    $name = $_FILES['photos']['name'][$i];

    if (in_array($type, $allowed)) {
      move_uploaded_file($tmp, "uploads/$name");
      echo "<img src='uploads/$name' class='img-thumbnail m-2' width='150'>";
    } else {
      echo "<div class='alert alert-warning'>تم تجاهل ملف غير مدعوم: $name</div>";
    }
  }
}
?>

<form method="post" enctype="multipart/form-data" class="p-3">
  <label class="form-label">اختر الصور:</label>
  <input type="file" name="photos[]" multiple class="form-control mb-2" required>
  <button class="btn btn-success">رفع الملفات</button>
</form>
