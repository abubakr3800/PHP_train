<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 1) {
    header("Location: login.php");
    exit;
}

include './db/db.php';
$result = mysqli_query($conn, "SELECT * FROM login_logs ORDER BY login_time DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Back to Dashboard</a>
    <span class="navbar-text text-white">Admin | <?= $_SESSION['user'] ?></span>
  </div>
</nav>

<div class="container mt-4">
  <h2 class="mb-4">📜 Login Logs</h2>
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Login Time</th>
        <th>IP Address</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['user_email'] ?></td>
          <td><?= $row['login_time'] ?></td>
          <td><?= $row['ip_address'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
