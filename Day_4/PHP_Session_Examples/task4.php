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
    $employees = [
      ["name" => "Ali", "department" => "IT", "salary" => 9500],
      ["name" => "Mona", "department" => "HR", "salary" => 7500],
      ["name" => "Khaled", "department" => "Finance", "salary" => 8200],
    ];
  ?>

<div class="container mt-5">
  <h2 class="text-success mb-4">High Salary Employees</h2>
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>Name</th>
        <th>Department</th>
        <th>Salary</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($employees as $emp): ?>
        <?php if ($emp["salary"] > 8000): ?>
          <tr>
            <td><?= $emp["name"] ?></td>
            <td><?= $emp["department"] ?></td>
            <td><?= $emp["salary"] ?></td>
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