<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

    <div class="container">
      <div class="row mt-5">
        <table class="table table-bordered table-striped">
          <tr><th>Key</th><th>Value</th></tr>
          <tr><td>PHP_SELF</td><td><?= $_SERVER['PHP_SELF'] ?></td></tr>
          <tr><td>SERVER_NAME</td><td><?= $_SERVER['SERVER_NAME'] ?></td></tr>
          <tr><td>HTTP_HOST</td><td><?= $_SERVER['HTTP_HOST'] ?></td></tr>
          <tr><td>USER_AGENT</td><td><?= $_SERVER['HTTP_USER_AGENT'] ?></td></tr>
          <tr><td>REQUEST_METHOD</td><td><?= $_SERVER['REQUEST_METHOD'] ?></td></tr>
        </table>
      </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 