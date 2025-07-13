<?php
// TASK 8: SIMPLE LOGIN SYSTEM
// This file demonstrates a simple login system with session management

session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Check if password is correct (hardcoded as "123")
    if ($password === '123') {
        // Password is correct - store username in session
        $_SESSION['user'] = $username;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        $success = true;
    } else {
        // Password is wrong
        $error = "Password is wrong! Please try again.";
    }
}

// Check if user is already logged in
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 8: Simple Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Task 8: Simple Login System</h1>
                
                <?php if ($isLoggedIn): ?>
                <!-- Welcome Page for Logged In User -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Welcome!</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <h5>Hello, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h5>
                            <p class="mb-0">You have successfully logged in with the correct password.</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Session Information:</h6>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Login Time:</strong> <?php echo $_SESSION['login_time']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Session ID:</strong> <?php echo session_id(); ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>System Information:</h6>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Current Time:</strong> <?php echo date('Y-m-d H:i:s'); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>PHP Version:</strong> <?php echo phpversion(); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Server:</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <a href="?logout=1" class="btn btn-danger">Logout</a>
                            <a href="simple_login.php" class="btn btn-primary">Refresh</a>
                        </div>
                    </div>
                </div>
                
                <?php else: ?>
                <!-- Login Form -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Login Form</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Login successful. Redirecting...
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <script>
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            </script>
                        <?php endif; ?>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                                <div class="form-text">Enter any username you want</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Password is: <strong>123</strong></div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        
                        <div class="mt-4">
                            <h6>Features Demonstrated:</h6>
                            <ul class="list-group">
                                <li class="list-group-item">✅ Session management</li>
                                <li class="list-group-item">✅ Form handling with POST method</li>
                                <li class="list-group-item">✅ Password verification (hardcoded)</li>
                                <li class="list-group-item">✅ Error handling and display</li>
                                <li class="list-group-item">✅ Bootstrap styling</li>
                                <li class="list-group-item">✅ Input validation</li>
                                <li class="list-group-item">✅ Logout functionality</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">This demonstrates basic PHP session management and form processing</small>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="text-center mt-4">
                    <a href="index.html" class="btn btn-secondary">Back to Task List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: simple_login.php");
    exit();
}
?> 