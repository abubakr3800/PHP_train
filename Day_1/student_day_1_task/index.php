<?php
// Simple Student Management System - Dashboard
session_start();

// Check if user is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

// Individual user variables instead of arrays
$user_one = ['name' => 'John Doe', 'course' => 'Computer Science', 'gpa' => 3.8];
$user_two = ['name' => 'Sarah Wilson', 'course' => 'Web Development', 'gpa' => 3.9];
$user_three = ['name' => 'Mike Johnson', 'course' => 'Software Engineering', 'gpa' => 3.7];

// Get current student data based on session
$currentStudent = null;
if ($_SESSION['student_id'] == 1) {
    $currentStudent = $user_one;
} elseif ($_SESSION['student_id'] == 2) {
    $currentStudent = $user_two;
} elseif ($_SESSION['student_id'] == 3) {
    $currentStudent = $user_three;
}

// Simple statistics
$total_students = 3;
$total_gpa = $user_one['gpa'] + $user_two['gpa'] + $user_three['gpa'];
$average_gpa = $total_gpa / $total_students;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Student Dashboard</h1>
                
                <!-- Welcome Message -->
                <div class="alert alert-success">
                    <h4>Welcome, <?php echo htmlspecialchars($currentStudent['name']); ?>!</h4>
                    <p>You are logged in successfully.</p>
                </div>

                <!-- Student Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>My Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($currentStudent['name']); ?></p>
                                <p><strong>Course:</strong> <?php echo htmlspecialchars($currentStudent['course']); ?></p>
                                <p><strong>GPA:</strong> <?php echo $currentStudent['gpa']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Student ID:</strong> <?php echo $_SESSION['student_id']; ?></p>
                                <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="students.php" class="btn btn-primary w-100">View All Students</a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="profile.php" class="btn btn-info w-100">My Profile</a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="courses.php" class="btn btn-success w-100">My Courses</a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="logout.php" class="btn btn-danger w-100">Logout</a>
                    </div>
                </div>

                <!-- Simple Stats -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Total Students</h5>
                                <h3 class="text-primary"><?php echo $total_students; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>My GPA</h5>
                                <h3 class="text-success"><?php echo $currentStudent['gpa']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Average GPA</h5>
                                <h3 class="text-info"><?php echo number_format($average_gpa, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 