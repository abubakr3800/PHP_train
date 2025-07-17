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
$products = [
  "Keyboard" => 300,
  "Mouse" => 150,
  "Monitor" => 1200,
  "Headset" => 400,
  "Chair" => 1000
];

arsort($products);
?>

<div class="container mt-4">
  <h5 class="text-danger">Product Prices</h5>
  <ul class="list-group">
    <?php foreach ($products as $product => $price): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= $product ?>
        <span class="badge bg-dark rounded-pill"><?= $price ?> EGP</span>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 