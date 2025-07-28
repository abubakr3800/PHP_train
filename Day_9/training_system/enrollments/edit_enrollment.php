<?php
include '../db/db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM enrollments WHERE id=$id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Enrollment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Edit Grade</h3>
  <form method="POST" action="update_enrollment.php?id=<?= $id ?>" class="card p-4 shadow-sm">
    <label>Grade:</label>
    <input type="number" step="0.01" name="grade" class="form-control mb-3" value="<?= $data['grade'] ?>">
    <button class="btn btn-primary">Update</button>
  </form>
</div>
</body>
</html>
