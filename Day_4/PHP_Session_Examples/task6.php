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
$courses = ["HTML", "CSS", "JS", "PHP"];
array_push($courses, "MySQL");
array_unshift($courses, "Git");
array_shift($courses);
?>

<div class="container mt-4">
  <h4 class="text-info">Available Courses</h4>
  <ul class="list-group">
    <?php foreach ($courses as $course): ?>
      <li class="list-group-item"><?= $course ?></li>
    <?php endforeach; ?>
  </ul>
</div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 