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
$students = [
  ["name" => "Ahmed", "grade" => 90],
  ["name" => "Sara", "grade" => 70],
  ["name" => "Ali", "grade" => 88],
  ["name" => "Noha", "grade" => 60],
];
?>

<div class="container mt-5">
  <h2 class="text-primary mb-4">Passed Students Only</h2>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Grade</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $student): ?>
        <?php if ($student["grade"] >= 85): ?>
          <tr>
            <td><?= $student["name"] ?></td>
            <td><?= $student["grade"] ?></td>
          </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 