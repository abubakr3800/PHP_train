<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Enrollments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Enrollments</h3>
  <?= $role == 1 ? '<a href="add_enrollment.php" class="btn btn-success mb-3">+ Add Enrollment</a>' : " "; ?>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Student</th><th>Course</th><th>Grade</th><th>Date</th><?= $role == 1 ? "<th>Actions </th>" : " "; ?>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT e.id, s.name AS student, c.title AS course, e.grade, e.enrollment_date
              FROM enrollments e
              JOIN students s ON e.student_id = s.id
              JOIN courses c ON e.course_id = c.id";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['student']}</td>
                <td>{$row['course']}</td>
                <td>{$row['grade']}</td>
                <td>{$row['enrollment_date']}</td>
                ";
                if($role == 1){
                  echo "<td>
                  <a href='edit_enrollment.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete_enrollment.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
