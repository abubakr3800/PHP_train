<?php
$name = $_POST['name'] ?? '';
$track = $_POST['track'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$errors = [];

if (!$name || !$track || !$email || !$phone) {
    $errors[] = "All fields are required.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submission Result</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 bg-white p-4 rounded shadow text-center">

<?php if ($errors): ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $error): ?>
      <p><?php echo $error; ?></p>
    <?php endforeach; ?>
  </div>
<?php else: ?>
  <h2 class="text-success">🎉 Thank you, <?php echo (explode(' ', $name)[0]); ?>!</h2>
  <p><strong>Track:</strong> <?php echo $track; ?></p>
  <p><strong>Email:</strong> <?php echo $email; ?></p>
  <p><strong>Phone:</strong> <?php echo $phone; ?></p>
<?php endif; ?>

    </div>
  </div>
</div>
</body>
</html>
