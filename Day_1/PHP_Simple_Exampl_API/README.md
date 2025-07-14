# Simple PHP API Example

## Overview
This is a simple PHP API that serves static array data as JSON responses. It demonstrates basic API concepts including endpoints, parameters, and JSON responses.

## Project Structure
```
PHP_Simple_Exampl_API/
├── api.php              # Main API file
└── README.md            # This documentation
```

## Features
- **JSON Response**: All responses are returned in JSON format
- **CORS Support**: Configured for cross-origin requests
- **Error Handling**: Proper HTTP status codes and error messages
- **Multiple Endpoints**: Different data types available
- **Parameter Support**: ID-based filtering for specific items

## API Endpoints

### 1. Get All Data
**URL:** `api.php` or `api.php?action=all`
**Method:** GET
**Response:** Returns all data (users, products, categories)

### 2. Get All Users
**URL:** `api.php?action=users`
**Method:** GET
**Response:** Returns array of all users

### 3. Get Specific User
**URL:** `api.php?action=users&id=1`
**Method:** GET
**Response:** Returns specific user by ID

### 4. Get All Products
**URL:** `api.php?action=products`
**Method:** GET
**Response:** Returns array of all products

### 5. Get Specific Product
**URL:** `api.php?action=products&id=1`
**Method:** GET
**Response:** Returns specific product by ID

### 6. Get All Categories
**URL:** `api.php?action=categories`
**Method:** GET
**Response:** Returns array of all categories

## Data Structure

### Users
Each user object contains:
- `id`: Unique identifier
- `name`: Full name
- `email`: Email address
- `age`: Age in years
- `city`: City of residence
- `skills`: Array of programming skills

### Products
Each product object contains:
- `id`: Unique identifier
- `name`: Product name
- `price`: Price in USD
- `category`: Product category
- `inStock`: Boolean indicating stock availability

### Categories
Simple array of category names.

## Usage Examples

### Using cURL
```bash
# Get all data
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php

# Get all users
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=users

# Get specific user
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=users&id=1

# Get all products
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=products

# Get specific product
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=products&id=2

# Get categories
curl http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=categories
```

### Using JavaScript (Fetch API)
```javascript
// Get all users
fetch('api.php?action=users')
    .then(response => response.json())
    .then(data => console.log(data));

// Get specific user
fetch('api.php?action=users&id=1')
    .then(response => response.json())
    .then(data => console.log(data));
```

### Using PHP
```php
// Get all products
$url = 'api.php?action=products';
$response = file_get_contents($url);
$products = json_decode($response, true);
```

## Error Responses

### 404 Not Found
When requesting a specific item that doesn't exist:
```json
{
    "error": "User not found"
}
```

### 500 Internal Server Error
When an unexpected error occurs:
```json
{
    "error": "Internal server error"
}
```

## Setup Instructions

1. **Place the files** in your web server directory (e.g., XAMPP htdocs)
2. **Start your web server** (Apache/PHP)
3. **Access the API** via browser or HTTP client
4. **Test the endpoints** using the examples above

## Requirements
- PHP 7.0 or higher
- Web server with PHP support (Apache, Nginx, etc.)
- No external dependencies required

## Browser Testing
You can test the API directly in your browser by visiting:
- `http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php`
- `http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=users`
- `http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/api.php?action=products`

## Learning Objectives
This project demonstrates:
- Basic PHP API development
- JSON response handling
- HTTP status codes
- URL parameter processing
- CORS configuration
- Error handling in APIs
- Static data serving 