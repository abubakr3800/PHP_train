<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Add New Course</h3>
  <form method="POST" action="insert_course.php" class="card p-4 shadow-sm">
    <input name="title" class="form-control mb-2" placeholder="Title" required>
    <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
    <input name="hours" type="number" step="0.5" class="form-control mb-2" placeholder="Hours">
    <input name="price" type="number" step="0.01" class="form-control mb-2" placeholder="Price">
    <button class="btn btn-success">Add Course</button>
  </form>
</div>
</body>
</html>
