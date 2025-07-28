<?php
include '../db/db.php';
$students = mysqli_query($conn, "SELECT id , name FROM students");
$courses = mysqli_query($conn, "SELECT id , title FROM courses");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Enrollment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Add New Enrollment</h3>
  <form method="POST" action="insert_enrollment.php" class="card p-4 shadow-sm">
    <label class="form-label">Select Student:</label>
    <select name="student_id" class="form-select mb-2" required>
      <?php while($s = mysqli_fetch_assoc($students)) {
        echo "<option value='{$s['id']}'>{$s['name']}</option>";
      } ?>
    </select>

    <label class="form-label">Select Course:</label>
    <select name="course_id" class="form-select mb-2" required>
      <?php while($c = mysqli_fetch_assoc($courses)) {
        echo "<option value='{$c['id']}'>{$c['title']}</option>";
      } ?>
    </select>

    <input name="grade" step="0.01" type="number" class="form-control mb-2" placeholder="Grade (optional)">
    <button class="btn btn-success">Enroll</button>
  </form>
</div>
</body>
</html>
