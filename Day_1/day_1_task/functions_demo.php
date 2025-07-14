<?php
// TASK 2: FUNCTIONS AND SCOPE
// This file demonstrates different types of functions and variable scope

// Global variable
$globalVar = "I am a global variable";

// 1. Simple function with no parameters
function simpleFunction() {
    return "Hello from a simple function!";
}

// 2. Function with parameters
function greet($name) {
    return "Hello, " . $name . "!";
}

// 3. Function that returns a value
function calculateArea($length, $width) {
    return $length * $width;
}

// 4. Function demonstrating local scope
function demonstrateLocalScope() {
    $localVar = "I am a local variable";
    return $localVar;
}

// 5. Function demonstrating global scope
function demonstrateGlobalScope() {
    global $globalVar;
    return $globalVar;
}

// 6. Static variable example
function counter() {
    static $count = 0;
    $count++;
    return $count;
}

// 7. Function that uses built-in PHP functions
function formatText($text) {
    return ucfirst(strtolower(trim($text)));
}

// 8. Function with default parameters
function createGreeting($name, $time = "today") {
    return "Good " . $time . ", " . $name . "!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2: Functions and Scope</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Task 2: Functions and Scope</h1>
                
                <!-- Simple Function -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>1. Simple Function with No Parameters</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function simpleFunction() {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return "Hello from a simple function!";<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Result:</h5>
                                <div class="alert alert-success">
                                    <?php echo simpleFunction(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Function with Parameters -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>2. Function with Parameters</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function greet($name) {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return "Hello, " . $name . "!";<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><?php echo greet("John"); ?></li>
                                    <li class="list-group-item"><?php echo greet("Sarah"); ?></li>
                                    <li class="list-group-item"><?php echo greet("Mike"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Function that Returns a Value -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>3. Function that Returns a Value</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function calculateArea($length, $width) {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return $length * $width;<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">Area (5 x 3): <?php echo calculateArea(5, 3); ?> square units</li>
                                    <li class="list-group-item">Area (10 x 7): <?php echo calculateArea(10, 7); ?> square units</li>
                                    <li class="list-group-item">Area (8 x 4): <?php echo calculateArea(8, 4); ?> square units</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Local Scope -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>4. Function Demonstrating Local Scope</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function demonstrateLocalScope() {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;$localVar = "I am a local variable";<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return $localVar;<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Result:</h5>
                                <div class="alert alert-info">
                                    <?php echo demonstrateLocalScope(); ?>
                                </div>
                                <small class="text-muted">Note: $localVar is only accessible inside the function</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Scope -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>5. Function Demonstrating Global Scope</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        $globalVar = "I am a global variable";<br><br>
                                        function demonstrateGlobalScope() {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;global $globalVar;<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return $globalVar;<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Result:</h5>
                                <div class="alert alert-warning">
                                    <?php echo demonstrateGlobalScope(); ?>
                                </div>
                                <small class="text-muted">Note: Using 'global' keyword to access global variable</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Static Variable -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>6. Static Variable Example</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function counter() {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;static $count = 0;<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;$count++;<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return $count;<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">First call: <?php echo counter(); ?></li>
                                    <li class="list-group-item">Second call: <?php echo counter(); ?></li>
                                    <li class="list-group-item">Third call: <?php echo counter(); ?></li>
                                    <li class="list-group-item">Fourth call: <?php echo counter(); ?></li>
                                </ul>
                                <small class="text-muted">Note: Static variable retains its value between function calls</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Built-in Functions -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>7. Function that Uses Built-in PHP Functions</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function formatText($text) {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return ucfirst(strtolower(trim($text)));<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">"hello world" → <?php echo formatText("hello world"); ?></li>
                                    <li class="list-group-item">"PHP PROGRAMMING" → <?php echo formatText("PHP PROGRAMMING"); ?></li>
                                    <li class="list-group-item">"  web development  " → <?php echo formatText("  web development  "); ?></li>
                                </ul>
                                <small class="text-muted">Uses: trim(), strtolower(), ucfirst()</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Default Parameters -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>8. Function with Default Parameters</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        function createGreeting($name, $time = "today") {<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;return "Good " . $time . ", " . $name . "!";<br>
                                        }
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><?php echo createGreeting("John"); ?></li>
                                    <li class="list-group-item"><?php echo createGreeting("Sarah", "morning"); ?></li>
                                    <li class="list-group-item"><?php echo createGreeting("Mike", "evening"); ?></li>
                                </ul>
                                <small class="text-muted">Note: $time parameter has default value "today"</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="index.html" class="btn btn-primary">Back to Task List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 