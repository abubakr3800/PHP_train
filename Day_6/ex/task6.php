<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $folder = "uploads/" . date("Y-m-d") . "/";
  if (!file_exists($folder)) mkdir($folder, 0777, true);

  $fileName = time() . "_" . basename($_FILES['image']['name']);
  $fullPath = $folder . $fileName;

  $allowedTypes = ['image/jpeg', 'image/png'];
  if (in_array($_FILES['image']['type'], $allowedTypes)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $fullPath);
    echo "Image uploaded to: $fullPath";
  } else {
    echo "<div class='alert alert-danger'>Invalid file type</div>";
  }
}