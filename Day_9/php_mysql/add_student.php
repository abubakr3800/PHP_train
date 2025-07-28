<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add New Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include "navigation.php"; ?>

<?php
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name  = ucfirst(strtolower(trim($_POST['name'])));
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $dob   = $_POST['dob'];

  if ($name && $email && $dob) {
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone, date_of_birth) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $dob);
    $stmt->execute();

    $msg = "<div class='alert alert-success'>Student added successfully.</div>";
  } else {
    $msg = "<div class='alert alert-danger'>Please fill all required fields.</div>";
  }
}
?>

<div class="container">
  <h2 class="mb-4">➕ Add New Student</h2>
  <?= $msg ?>

  <form method="POST" class="row g-3 needs-validation" novalidate>
    <div class="col-md-6">
      <label class="form-label">Full Name *</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email *</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control">
    </div>
    <div class="col-md-6">
      <label class="form-label">Date of Birth *</label>
      <input type="date" name="dob" class="form-control" required>
    </div>
    <div class="col-12">
      <button class="btn btn-primary">Add Student</button>
    </div>
  </form>
</div>

</body>
</html>
