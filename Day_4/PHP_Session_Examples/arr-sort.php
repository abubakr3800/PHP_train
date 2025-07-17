<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success">

<?php
$courses = [
  "php" => 150,
  "html" => 90,
  "css" => 100,
  "js" => 130
];

// ترتيب تصاعدي مع الحفاظ على الـ key
asort($courses);
?>

<div class="container mt-4">
  <h4 class="text-success">Courses by Enrollment</h4>
  <ul class="list-group">
    <?php foreach ($courses as $course => $students): ?>
      <li class="list-group-item d-flex justify-content-between">
        <span><?= strtoupper($course) ?></span>
        <span class="badge bg-primary rounded-pill"><?= $students ?> Students</span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>


    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 