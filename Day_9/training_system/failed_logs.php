<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 1) {
    header("Location: login.php");
    exit;
}

$logFile = 'logs/failed_login.log';
$lines = [];

if (file_exists($logFile)) {
    $lines = array_reverse(file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Failed Login Logs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <span class="navbar-text text-white">Admin | <?= $_SESSION['user'] ?></span>
    <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-4">
  <h2 class="mb-4">🚨 Failed Login Attempts</h2>
  
  <?php if (!empty($lines)): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Log Entry</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lines as $index => $line): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($line) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No failed login attempts recorded yet.</div>
  <?php endif; ?>
</div>
</body>
</html>
