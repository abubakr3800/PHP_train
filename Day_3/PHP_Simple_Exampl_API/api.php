<?php
// Simple PHP API for serving static array data
// Set content type to JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// Fixed array data
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

// Get request parameters
$action = $_GET['action'] ?? 'all';
$id = $_GET['id'] ?? null;

// Handle different API endpoints
try {
    switch ($action) {
        case 'users':
            if ($id) {
                // Get specific user by ID
                $user = array_filter($data['users'], function($user) use ($id) {
                    return $user['id'] == $id;
                });
                $user = array_values($user);
                if (empty($user)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'User not found']);
                } else {
                    echo json_encode($user[0]);
                }
            } else {
                // Get all users
                echo json_encode($data['users']);
            }
            break;
            
        case 'products':
            if ($id) {
                // Get specific product by ID
                $product = array_filter($data['products'], function($product) use ($id) {
                    return $product['id'] == $id;
                });
                $product = array_values($product);
                if (empty($product)) {
                    http_response_code(404);
                    echo json_encode(['error' => 'Product not found']);
                } else {
                    echo json_encode($product[0]);
                }
            } else {
                // Get all products
                echo json_encode($data['products']);
            }
            break;
            
        case 'categories':
            // Get all categories
            echo json_encode($data['categories']);
            break;
            
        case 'all':
        default:
            // Get all data
            echo json_encode($data);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
?> 