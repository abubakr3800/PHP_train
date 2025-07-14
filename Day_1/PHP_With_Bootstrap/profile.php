<?php
// Get form data
$fullname = $_POST['fullname'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? '';
$city = $_POST['city'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #5ad884ff 0%, #599041ff 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .profile-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-container">
                    <h2 class="text-center mb-4">User Profile</h2>
                    
                    <?php if ($fullname): ?>
                        <div class="alert alert-success">
                            <strong>Welcome, <?php echo htmlspecialchars($fullname); ?>!</strong>
                        </div>
                        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">User Information</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Full Name:</strong> <?php echo htmlspecialchars($fullname); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Age:</strong> <?php echo htmlspecialchars($age) ?: 'Not provided'; ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>City:</strong> <?php echo htmlspecialchars($city) ?: 'Not provided'; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="./" class="btn btn-primary">Back to Form</a>
                        </div>
                        
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong>No data submitted!</strong> Please go back to the form.
                        </div>
                        
                        <div class="text-center">
                            <a href="./" class="btn btn-primary">Go to Form</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 