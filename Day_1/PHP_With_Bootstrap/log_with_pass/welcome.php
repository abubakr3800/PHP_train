<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: log_with_pass.php");
    exit();
}

$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h4 class="mb-0">Welcome!</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="alert alert-success">
                            <h5>Hello, <?php echo htmlspecialchars($username); ?>!</h5>
                            <p class="mb-0">You have successfully logged in with the correct password.</p>
                        </div>
                        
                        <div class="mt-4">
                            <h6>Session Information:</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Username:</strong> <?php echo htmlspecialchars($username); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Session ID:</strong> <?php echo session_id(); ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="mt-4">
                            <a href="./" class="btn btn-primary">Back to Login</a>
                            <a href="clear_session.php" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 