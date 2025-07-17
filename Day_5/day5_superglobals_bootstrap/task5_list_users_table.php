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
  $users = $_SESSION['users'] ?? [];
  if ($users): ?>
    <table class="table table-striped m-3">
      <thead><tr><th>#</th><th>Name</th><th>Email</th></tr></thead>
      <tbody>
        <?php foreach ($users as $i => $user): ?>
          <tr><td><?= $i+1 ?></td><td><?= $user['name'] ?></td><td><?= $user['email'] ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

</body>
</html>