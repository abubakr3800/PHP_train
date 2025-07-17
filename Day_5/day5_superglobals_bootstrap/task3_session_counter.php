<?php
  session_start();
  $_SESSION['visits'] = ($_SESSION['visits'] ?? 0) + 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <p class="m-3">You visited this page <span class="badge bg-primary"><?= $_SESSION['visits'] ?></span> times.</p>
</body>
</html>
