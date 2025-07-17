<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<?php
$students = [
  "Ahmed" => 85,
  "Salma" => 92,
  "Youssef" => 48,
  "Nour" => 77,
  "Omar" => 60
];

$passed = array_filter($students, function($grade) {
  return $grade >= 60;
});
?>

<div class="container mt-4">
  <h4 class="text-success">Passed Students</h4>
  <ul class="list-group">
    <?php foreach ($passed as $name => $grade): ?>
      <li class="list-group-item d-flex justify-content-between">
        <strong><?= $name ?></strong>
        <span class="badge bg-primary"><?= $grade ?>%</span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>


    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 