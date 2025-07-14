<?php
// Simple PHP fullstack approach - no API needed
// Data array (same as in api.php)
$data = [
    'users' => [
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'age' => 30,
            'city' => 'New York',
            'skills' => ['PHP', 'JavaScript', 'MySQL']
        ],
        [
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'age' => 25,
            'city' => 'Los Angeles',
            'skills' => ['Python', 'React', 'MongoDB']
        ],
        [
            'id' => 3,
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@example.com',
            'age' => 35,
            'city' => 'Chicago',
            'skills' => ['Java', 'Spring Boot', 'PostgreSQL']
        ],
        [
            'id' => 4,
            'name' => 'Sarah Wilson',
            'email' => 'sarah.wilson@example.com',
            'age' => 28,
            'city' => 'Boston',
            'skills' => ['C#', '.NET', 'SQL Server']
        ],
        [
            'id' => 5,
            'name' => 'David Brown',
            'email' => 'david.brown@example.com',
            'age' => 32,
            'city' => 'Seattle',
            'skills' => ['Go', 'Docker', 'Kubernetes']
        ]
    ],
    'products' => [
        [
            'id' => 1,
            'name' => 'Laptop',
            'price' => 999.99,
            'category' => 'Electronics',
            'inStock' => true
        ],
        [
            'id' => 2,
            'name' => 'Smartphone',
            'price' => 699.99,
            'category' => 'Electronics',
            'inStock' => true
        ],
        [
            'id' => 3,
            'name' => 'Headphones',
            'price' => 199.99,
            'category' => 'Audio',
            'inStock' => false
        ],
        [
            'id' => 4,
            'name' => 'Coffee Maker',
            'price' => 89.99,
            'category' => 'Home & Kitchen',
            'inStock' => true
        ],
        [
            'id' => 5,
            'name' => 'Running Shoes',
            'price' => 129.99,
            'category' => 'Sports',
            'inStock' => true
        ]
    ],
    'categories' => [
        'Electronics',
        'Audio',
        'Home & Kitchen',
        'Sports',
        'Books',
        'Clothing'
    ]
];

// Get what to display from URL parameter
$display = $_GET['display'] ?? 'all';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Fullstack Data Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .skill-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .nav-tabs {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">PHP Fullstack Data Display</h1>
        <p class="text-center text-muted">Simple way to fetch and display data without API calls</p>
        
        <!-- Navigation -->
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link <?php echo $display === 'all' ? 'active' : ''; ?>" href="?display=all">All Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $display === 'users' ? 'active' : ''; ?>" href="?display=users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $display === 'products' ? 'active' : ''; ?>" href="?display=products">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $display === 'categories' ? 'active' : ''; ?>" href="?display=categories">Categories</a>
            </li>
        </ul>

        <?php if ($display === 'all' || $display === 'users'): ?>
        <!-- Users Section -->
        <div class="row">
            <div class="col-12">
                <h2>Users</h2>
                <div class="row">
                    <?php foreach ($data['users'] as $user): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($user['name']); ?></h5>
                                <p class="card-text">
                                    <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?><br>
                                    <strong>Age:</strong> <?php echo $user['age']; ?><br>
                                    <strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?>
                                </p>
                                <div>
                                    <strong>Skills:</strong><br>
                                    <?php foreach ($user['skills'] as $skill): ?>
                                        <span class="badge bg-primary skill-badge"><?php echo htmlspecialchars($skill); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($display === 'all' || $display === 'products'): ?>
        <!-- Products Section -->
        <div class="row">
            <div class="col-12">
                <h2>Products</h2>
                <div class="row">
                    <?php foreach ($data['products'] as $product): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text">
                                    <strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?><br>
                                    <strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?><br>
                                    <strong>In Stock:</strong> 
                                    <?php if ($product['inStock']): ?>
                                        <span class="badge bg-success">Yes</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">No</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($display === 'all' || $display === 'categories'): ?>
        <!-- Categories Section -->
        <div class="row">
            <div class="col-12">
                <h2>Categories</h2>
                <div class="row">
                    <?php foreach ($data['categories'] as $category): ?>
                    <div class="col-md-4 col-lg-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($category); ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Summary Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="alert alert-info">
                    <h4>Summary</h4>
                    <p><strong>Total Users:</strong> <?php echo count($data['users']); ?></p>
                    <p><strong>Total Products:</strong> <?php echo count($data['products']); ?></p>
                    <p><strong>Total Categories:</strong> <?php echo count($data['categories']); ?></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 