<?php
// task1_server_info.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h3>Server Information</h3>
  <table class="table table-bordered">
    <?php foreach ($_SERVER as $key => $value): ?>
      <tr>
        <th><?php echo htmlspecialchars($key); ?></th>
        <td><?php echo htmlspecialchars($value); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
