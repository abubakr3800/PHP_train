<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Info Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h3>Session and Server Info</h3>
  <ul class="list-group">
    <li class="list-group-item">Session User: <?php echo $_SESSION['user'] ?? 'None'; ?></li>
    <li class="list-group-item">IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
    <li class="list-group-item">Agent: <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>
  </ul>
</body>
</html>
