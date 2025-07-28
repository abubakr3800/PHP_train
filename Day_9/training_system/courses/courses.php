<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Courses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Course List</h3>
  

  <?= $role == 1 ? '<a href="add_enrollment.php" class="btn btn-success mb-3">+ Add Enrollment</a>' : " "; ?>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Title</th><th>Hours</th><th>Price</th><?= $role == 1 ? "<th>Actions </th>" : " "; ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $res = mysqli_query($conn, "SELECT * FROM courses");
      while ($c = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$c['title']}</td>
                <td>{$c['hours']}</td>
                <td>{$c['price']} EGP</td>
                 ";
                if($role == 1){
                  echo "<td>
                  <a href='edit_course.php?id={$c['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete_course.php?id={$c['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>";
                }
                echo "</tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
