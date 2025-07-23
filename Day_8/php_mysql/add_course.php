<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add New Course</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include "navigation.php"; ?>

<?php
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $hours = $_POST['hours'];
  $price = $_POST['price'];

  if ($title && $hours) {
    $stmt = $conn->prepare("INSERT INTO courses (title, description, hours, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdd", $title, $desc, $hours, $price);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Course added.</div>";
  } else {
    $msg = "<div class='alert alert-danger'>Please fill required fields.</div>";
  }
}
?>

<div class="container">
  <h2 class="mb-4">📘 Add New Course</h2>
  <?= $msg ?>
  <form method="POST" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Title *</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Hours *</label>
      <input type="number" step="0.25" name="hours" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Price</label>
      <input type="number" step="0.01" name="price" class="form-control">
    </div>
    <div class="col-12">
      <label class="form-label">Description</label>
      <textarea name="description" rows="3" class="form-control"></textarea>
    </div>
    <div class="col-12">
      <button class="btn btn-success">Add Course</button>
    </div>
  </form>
</div>
</body>
</html>
