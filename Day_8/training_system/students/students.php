<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Student List</h3>
  <a href="add_student.php" class="btn btn-success mb-3">+ Add Student</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $q = "SELECT * FROM students";
      $res = mysqli_query($conn, $q);
      // var_dump($res);
      while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>
                  <a href='edit_student.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete_student.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
