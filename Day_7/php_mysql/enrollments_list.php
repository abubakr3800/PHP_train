<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Enrollments</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include "navigation.php"; ?>

<div class="container">
  <h2 class="mb-4">📋 Enrolled Students in Courses</h2>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Student</th>
        <th>Email</th>
        <th>Course</th>
        <th>Grade</th>
        <th>Enrolled At</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT 
                students.name AS student_name,
                students.email,
                courses.title AS course_title,
                enrollments.grade,
                enrollments.enrollment_date
              FROM enrollments
              JOIN students ON students.id = enrollments.student_id
              JOIN courses ON courses.id = enrollments.course_id
              ORDER BY enrollments.enrollment_date DESC";

      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
          <tr>
            <td><?= $row['student_name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['course_title'] ?></td>
            <td><?= $row['grade'] ?></td>
            <td><?= $row['enrollment_date'] ?></td>
          </tr>
      <?php
        endwhile;
      else:
        echo "<tr><td colspan='5' class='text-center'>No enrollments yet.</td></tr>";
      endif;
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
