<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <!-- GET Form -->
    <form method="get" class="m-3">
    <input name="name" placeholder="Your name" class="form-control mb-2">
    <button class="btn btn-primary">Send (GET)</button>
    </form>
    <?php if (isset($_GET['name'])) echo "<div class='alert alert-info'>Hi, {$_GET['name']}</div>"; ?>

    <!-- POST Form -->
    <form method="post" class="m-3">
    <input name="name" placeholder="Your name" class="form-control mb-2">
    <button class="btn btn-success">Send (POST)</button>
    </form>
    <?php if (isset($_POST['name'])) echo "<div class='alert alert-success'>Hello, {$_POST['name']}</div>"; ?>
</body>
</html>