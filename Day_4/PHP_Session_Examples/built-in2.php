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
$tasks = ["Read Docs", "Fix Bugs", "Push Code"];

array_push($tasks, "Deploy App");
array_unshift($tasks, "Check Emails");
array_pop($tasks);
array_shift($tasks);
?>

<div class="container mt-4">
  <h3 class="mb-3">To-Do List (After Edits)</h3>
  <ul class="list-group">
    <?php foreach ($tasks as $task): ?>
      <li class="list-group-item"><?= $task ?></li>
    <?php endforeach; ?>
  </ul>
</div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 