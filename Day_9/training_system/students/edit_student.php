<?php
include '../db/db.php';
$id = $_GET['id'];
$s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id=$id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Edit Student</h3>
  <form method="POST" action="update_student.php?id=<?= $id ?>" class="card p-4 shadow-sm">
    <input name="name" value="<?= $s['name'] ?>" class="form-control mb-2" required>
    <input name="email" value="<?= $s['email'] ?>" class="form-control mb-2">
    <input name="phone" value="<?= $s['phone'] ?>" class="form-control mb-2">
    <input name="dob" type="date" value="<?= $s['date_of_birth'] ?>" class="form-control mb-2">
    <button class="btn btn-primary">Update</button>
  </form>
</div>
</body>
</html>
