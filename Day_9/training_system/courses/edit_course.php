<?php
include '../db/db.php';
$id = $_GET['id'];
$c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM courses WHERE id=$id"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Edit Course</h3>
  <form method="POST" action="update_course.php?id=<?= $id ?>" class="card p-4 shadow-sm">
    <input name="title" value="<?= $c['title'] ?>" class="form-control mb-2" required>
    <textarea name="description" class="form-control mb-2"><?= $c['description'] ?></textarea>
    <input name="hours" value="<?= $c['hours'] ?>" type="number" step="0.5" class="form-control mb-2">
    <input name="price" value="<?= $c['price'] ?>" type="number" step="0.01" class="form-control mb-2">
    <button class="btn btn-primary">Update</button>
  </form>
</div>
</body>
</html>
