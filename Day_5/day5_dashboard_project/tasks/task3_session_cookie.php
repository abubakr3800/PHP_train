<?php
// task3_session_cookie.php
session_start();
if (isset($_POST['username'])) {
  $_SESSION['username'] = $_POST['username'];
  setcookie("theme", "dark", time() + 3600);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Session & Cookie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control">
    </div>
    <button class="btn btn-primary">Set Session & Cookie</button>
  </form>
  <hr>
  <h5>Session:</h5>
  <pre><?php print_r($_SESSION); ?></pre>
  <h5>Cookie:</h5>
  <pre><?php print_r($_COOKIE); ?></pre>
</body>
</html>
