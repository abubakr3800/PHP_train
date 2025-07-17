<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $file = $_FILES['pic'];
  $allowed = ['image/jpeg', 'image/png'];
  $max_size = 2 * 1024 * 1024;

  if ($file['error'] == 0 && in_array($file['type'], $allowed) && $file['size'] <= $max_size) {
    
    // تحديد مجلد التاريخ
    $dateFolder = 'uploads/' . date('Y-m-d');
    if (!is_dir($dateFolder)) {
      mkdir($dateFolder, 0777, true);
    }

    // استخراج الامتداد واسم الملف
    $originalName = basename($file['name']);
    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
    $newName = uniqid('img_', true) . '.' . $ext;

    // مسار الحفظ
    $destination = "$dateFolder/$newName";
    move_uploaded_file($file['tmp_name'], $destination);

    echo "<div class='alert alert-success m-3'>تم رفع الصورة داخل: <code>$destination</code></div>";
    echo "<img src='$destination' class='img-thumbnail m-3' width='200'>";
  } else {
    echo "<div class='alert alert-danger m-3'>الملف غير صالح أو كبير جدًا.</div>";
  }
}
?>

<form method="post" enctype="multipart/form-data" class="p-3">
  <label class="form-label">اختر صورة:</label>
  <input type="file" name="pic" required class="form-control mb-2">
  <button class="btn btn-success">رفع</button>
</form>
