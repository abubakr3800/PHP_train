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
  ["name" => "Sara", "grade" => 85],
  ["name" => "Ali", "grade" => 78],
];
?>

<div class="container mt-5">
  <h2 class="text-dark mb-4">Student Grades</h2>
  <table class="table table-bordered">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Grade</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $student): ?>
        <tr>
          <td><?= $student["name"] ?></td>
          <td><?= $student["grade"] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!--  -->


  <?php
    $person = [
        "Name" => "Ahmed",
        "Age" => 23,
        "Email" => "ahmed@example.com",
        "City" => "Cairo"
    ];
  ?>
  
    <h2 class="text-primary">User Info</h2>
    <ul class="list-group">
      <?php foreach ($person as $key => $value): ?>
        <li class="list-group-item">
          <strong><?= $key ?>:</strong> <?= $value ?>
        </li>
      <?php endforeach; ?>
    </ul>

</div>


    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 