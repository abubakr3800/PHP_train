<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['users'][] = [
      'name' => $_POST['name'],
      'email' => $_POST['email']
    ];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <form method="post" class="p-3">
    <input type="text" name="name" placeholder="Name" class="form-control mb-2" required>
    <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>
    <button type="submit" class="btn btn-success">Save</button>
  </form>
</body>
</html>