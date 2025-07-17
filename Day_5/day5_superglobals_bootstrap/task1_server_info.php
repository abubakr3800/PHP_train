<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Server Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<div class="container mt-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <strong>URL:</strong> <?= $_SERVER['REQUEST_URI'] ?>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <strong>Browser:</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card"><div class="card-body">
        <strong>IP:</strong> <?= $_SERVER['REMOTE_ADDR'] ?>
      </div></div>
    </div>
  </div>
</div>
<script src=""></script>
</body>
</html>