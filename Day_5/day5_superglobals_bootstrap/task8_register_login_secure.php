<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $_SESSION['users'][] = ['name' => $name, 'email' => $email, 'password' => $password];
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
      foreach ($_SESSION['users'] as $user) {
        if ($user['email'] === $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
          $_SESSION['auth'] = $user;
          echo "<div class='alert alert-success'>Login successful. Welcome {$user['name']}!</div>";
          exit;
        }
      }
      echo "<div class='alert alert-danger'>Invalid credentials.</div>";
    }
  ?>
</body>
</html>