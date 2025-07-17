<?php
// إعداد رفع الصور
$errors = [];
$team = [];
$specialties = ["Developer", "Designer", "Manager"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];
    
    // Validate and upload image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            $uploadDir = 'uploads/' . date('Y-m-d') . '/';
            if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);
            
            $imageName = basename($_FILES['image']['name']);
            $targetPath = $uploadDir . time() . '_' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);
        } else {
            $errors[] = "Only JPG and PNG files are allowed.";
        }
    } else {
        $errors[] = "Please upload a valid image.";
    }

    if (empty($errors)) {
        $team[] = [
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'image' => $targetPath ?? '',
        ];
    }
}

// فلترة التخصص
$filterRole = $_GET['filter'] ?? '';
$filteredTeam = array_filter($team, function($member) use ($filterRole) {
    return $filterRole === '' || $member['role'] === $filterRole;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Team Manager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">

  <!-- Server Info -->
  <div class="alert alert-info">
    <strong>Browser:</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?><br>
    <strong>Your IP:</strong> <?= $_SERVER['REMOTE_ADDR'] ?>
  </div>

  <!-- Errors -->
  <?php foreach($errors as $error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endforeach; ?>

  <!-- Form -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">Add New Team Member</div>
    <div class="card-body">
      <form method="POST" enctype="multipart/form-data" class="row g-3 was-validated" novalidate>
        <div class="col-md-6">
          <label class="form-label">Name</label>
          <input name="name" class="form-control is-valid" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control is-valid" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Role</label>
          <select name="role" class="form-select is-valid" required>
            <option value="">Choose...</option>
            <?php foreach ($specialties as $sp): ?>
              <option value="<?= $sp ?>"><?= $sp ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label">Profile Image</label>
          <input type="file" name="image" class="form-control is-valid" required>
        </div>
        <div class="col-12">
          <button class="btn btn-success">Add Member</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Filter -->
  <form method="GET" class="mb-3">
    <select name="filter" class="form-select w-25 d-inline-block">
      <option value="">Show All</option>
      <?php foreach ($specialties as $sp): ?>
        <option <?= $filterRole == $sp ? 'selected' : '' ?> value="<?= $sp ?>"><?= $sp ?></option>
      <?php endforeach; ?>
    </select>
    <button class="btn btn-secondary">Filter</button>
  </form>

  <!-- Table -->
  <?php if (!empty($filteredTeam)): ?>
    <table class="table table-bordered table-striped">
      <thead><tr><th>Image</th><th>Name</th><th>Email</th><th>Role</th></tr></thead>
      <tbody>
        <?php foreach ($filteredTeam as $member): ?>
          <tr>
            <td><img src="<?= $member['image'] ?>" width="50" height="50" class="rounded-circle"></td>
            <td><?= $member['name'] ?></td>
            <td><?= $member['email'] ?></td>
            <td><span class="badge bg-info"><?= $member['role'] ?></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">No team members found.</div>
  <?php endif; ?>
</div>
</body>
</html>
