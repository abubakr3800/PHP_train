<?php
// Simple Students Listing Page
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

// Simple search
$search = $_GET['search'] ?? '';
$filtered_students = [];

// Check each user individually for search
if (empty($search)) {
    // Show all students if no search
    $filtered_students = [
        1 => $user_one,
        2 => $user_two,
        3 => $user_three,
    ];
} else {
    // Search through each user individually
    if (stripos($user_one['name'], $search) !== false || stripos($user_one['course'], $search) !== false) {
        $filtered_students[1] = $user_one;
    }
    if (stripos($user_two['name'], $search) !== false || stripos($user_two['course'], $search) !== false) {
        $filtered_students[2] = $user_two;
    }
    if (stripos($user_three['name'], $search) !== false || stripos($user_three['course'], $search) !== false) {
        $filtered_students[3] = $user_three;
    }
}

// Calculate average GPA manually
$total_gpa = $user_one['gpa'] + $user_two['gpa'] + $user_three['gpa'] ;
$average_gpa = $total_gpa / 5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">All Students</h1>
                
                <!-- Search Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Search Students</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="" class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="search" 
                                       value="<?php echo htmlspecialchars($search); ?>" 
                                       placeholder="Search by name or course">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="students.php" class="btn btn-secondary">Clear</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Count -->
                <div class="alert alert-info">
                    Found <?php echo count($filtered_students); ?> student(s)
                </div>

                <!-- Students Table -->
                <div class="card">
                    <div class="card-header">
                        <h5>Students List</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($filtered_students)): ?>
                            <p class="text-center text-muted">No students found.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>GPA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($filtered_students as $id => $student): ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                                                <td><?php echo htmlspecialchars($student['course']); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $student['gpa'] >= 3.8 ? 'success' : ($student['gpa'] >= 3.5 ? 'warning' : 'danger'); ?>">
                                                        <?php echo $student['gpa']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Simple Stats -->
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Total Students</h5>
                                <h3 class="text-primary">3</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Average GPA</h5>
                                <h3 class="text-success"><?php echo number_format($average_gpa, 2); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Search Results</h5>
                                <h3 class="text-info"><?php echo count($filtered_students); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="text-center mt-4">
                    <a href="index.php" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 