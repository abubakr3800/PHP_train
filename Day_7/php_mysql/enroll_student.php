<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Enroll Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include "navigation.php"; ?>

<?php
$msg = "";
$students = $conn->query("SELECT id, name FROM students");
$courses = $conn->query("SELECT id, title FROM courses");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $student_id = $_POST['student_id'];
  $course_id = $_POST['course_id'];
  $grade = $_POST['grade'];

  if ($student_id && $course_id) {
    $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_id, grade, enrollment_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iid", $student_id, $course_id, $grade);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Student enrolled successfully.</div>";
  }
}
?>

<div class="container">
  <h2 class="mb-4">📝 Enroll Student in a Course</h2>
  <?= $msg ?>
  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Student</label>
      <select name="student_id" class="form-select" required>
        <option value="">-- Select Student --</option>
        <?php while($s = $students->fetch_assoc()): ?>
          <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Course</label>
      <select name="course_id" class="form-select" required>
        <option value="">-- Select Course --</option>
        <?php while($c = $courses->fetch_assoc()): ?>
          <option value="<?= $c['id'] ?>"><?= $c['title'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Grade</label>
      <input type="number" step="0.1" name="grade" class="form-control">
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Enroll</button>
    </div>
  </form>
</div>
</body>
</html>
