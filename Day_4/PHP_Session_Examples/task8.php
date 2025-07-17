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
$employees = [
  "Ali" => 4500,
  "Mona" => 6000,
  "Tarek" => 7000,
  "Laila" => 3000,
  "Ziad" => 5500
];

$highEarners = array_filter($employees, function($salary) {
  return $salary > 5000;
});
?>

<div class="container mt-4">
  <h5 class="text-info">High Salary Employees</h5>
  <ul class="list-group">
    <?php foreach ($highEarners as $name => $salary): ?>
      <li class="list-group-item d-flex justify-content-between">
        <?= $name ?>
        <span class="badge bg-dark"><?= $salary ?> EGP</span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 