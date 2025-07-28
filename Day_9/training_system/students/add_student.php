<?php include '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '../navbar.php'; ?>
<div class="container mt-4">
  <h3 class="mb-3">Add New Student</h3>

  <form method="POST" action="insert_student.php" class="card p-4 shadow-sm">
    <input name="name" class="form-control mb-2" placeholder="Name" required>
    <input name="email" type="email" class="form-control mb-2" placeholder="Email">
    <input name="phone" class="form-control mb-2" placeholder="Phone">
    <input name="dob" type="date" class="form-control mb-2" placeholder="Date of Birth">
    <button class="btn btn-success">Add Student</button>
  </form>

</div>
</body>
</html>
