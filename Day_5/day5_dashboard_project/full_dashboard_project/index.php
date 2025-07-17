<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  $_SESSION['user'] = $_POST['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    function showModal() {
      const myModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
      myModal.show();
    }
  </script>
</head>
<body class="container mt-5" onload="showModal()">
  <h2>Welcome to Dashboard</h2>
  <form method="POST" class="mb-3">
    <label>Name:</label>
    <input type="text" name="name" class="form-control" required>
    <button class="btn btn-success mt-2">Save</button>
  </form>

  <div class="modal fade" id="welcomeModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Welcome</h5></div>
        <div class="modal-body">
          <?php echo isset($_SESSION['user']) ? "Hello, " . htmlspecialchars($_SESSION['user']) . " <a href='info.php'>see your data</a> <a href='log.php'>see log dates</a>" : "Welcome Guest"; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a type="button" href="logout.php" class="btn btn-danger">logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
