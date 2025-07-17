<?php
// task2_post_form.php
$name = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>POST Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    (() => {
      window.addEventListener('load', () => {
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      });
    })();
  </script>
</head>
<body class="container mt-5">
  <h3>Enter your name</h3>
  <form method="POST" class="needs-validation" novalidate>
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" required>
      <div class="invalid-feedback">Please enter your name.</div>
    </div>
    <button class="btn btn-primary">Submit</button>
  </form>
  <?php if ($name): ?>
    <div class="alert alert-success mt-3">Welcome, <?php echo htmlspecialchars($name); ?>!</div>
  <?php endif; ?>
</body>
</html>
