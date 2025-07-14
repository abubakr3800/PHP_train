<?php
// TASK 1: BASIC PHP SYNTAX AND VARIABLES
// This file demonstrates basic PHP syntax, variables, data types, and operations
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1: Basic PHP Syntax and Variables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Task 1: Basic PHP Syntax and Variables</h1>
                
                <!-- PHP Opening and Closing Tags -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>1. PHP Opening and Closing Tags</h3>
                    </div>
                    <div class="card-body">
                        <p>PHP code is enclosed in &lt;?php ?&gt; tags</p>
                        <div class="bg-dark text-light p-3 rounded">
                            <code>&lt;?php<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;echo 'Hello World!';<br>
                            ?&gt;</code>
                        </div>
                        <div class="mt-3">
                            <strong>Output:</strong> 
                            <?php echo 'Hello World!'; ?>
                        </div>
                    </div>
                </div>

                <!-- Variable Declaration and Usage -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>2. Variable Declaration and Usage</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Variable declarations
                        $name = "John Doe";
                        $age = 25;
                        $height = 5.8;
                        $isStudent = true;
                        $skills = ["PHP", "HTML", "CSS", "JavaScript"];
                        $nullVar = null;
                        ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Variable Declarations:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        $name = "John Doe";<br>
                                        $age = 25;<br>
                                        $height = 5.8;<br>
                                        $isStudent = true;<br>
                                        $skills = ["PHP", "HTML", "CSS", "JavaScript"];<br>
                                        $nullVar = null;
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Variable Values:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Name:</strong> <?php echo $name; ?></li>
                                    <li class="list-group-item"><strong>Age:</strong> <?php echo $age; ?></li>
                                    <li class="list-group-item"><strong>Height:</strong> <?php echo $height; ?> feet</li>
                                    <li class="list-group-item"><strong>Is Student:</strong> <?php echo $isStudent ? "Yes" : "No"; ?></li>
                                    <li class="list-group-item"><strong>Skills:</strong> <?php echo implode(", ", $skills); ?></li>
                                    <li class="list-group-item"><strong>Null Variable:</strong> <?php echo is_null($nullVar) ? "null" : "not null"; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Types and gettype() Function -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>3. Data Types and gettype() Function</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Different data types
                        $stringVar = "Hello World";
                        $integerVar = 42;
                        $floatVar = 3.14;
                        $booleanVar = true;
                        $arrayVar = array(1, 2, 3);
                        $nullVar = null;
                        ?>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Variable</th>
                                        <th>Value</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>$stringVar</td>
                                        <td><?php echo $stringVar; ?></td>
                                        <td><span class="badge bg-primary"><?php echo gettype($stringVar); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>$integerVar</td>
                                        <td><?php echo $integerVar; ?></td>
                                        <td><span class="badge bg-success"><?php echo gettype($integerVar); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>$floatVar</td>
                                        <td><?php echo $floatVar; ?></td>
                                        <td><span class="badge bg-info"><?php echo gettype($floatVar); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>$booleanVar</td>
                                        <td><?php echo $booleanVar ? "true" : "false"; ?></td>
                                        <td><span class="badge bg-warning"><?php echo gettype($booleanVar); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>$arrayVar</td>
                                        <td>[<?php echo implode(", ", $arrayVar); ?>]</td>
                                        <td><span class="badge bg-secondary"><?php echo gettype($arrayVar); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>$nullVar</td>
                                        <td>null</td>
                                        <td><span class="badge bg-dark"><?php echo gettype($nullVar); ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- String Concatenation -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>4. String Concatenation</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $firstName = "John";
                        $lastName = "Doe";
                        $fullName = $firstName . " " . $lastName;
                        $greeting = "Hello, " . $fullName . "!";
                        ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Code:</h5>
                                <div class="bg-dark text-light p-3 rounded">
                                    <code>
                                        $firstName = "John";<br>
                                        $lastName = "Doe";<br>
                                        $fullName = $firstName . " " . $lastName;<br>
                                        $greeting = "Hello, " . $fullName . "!";
                                    </code>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Results:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>First Name:</strong> <?php echo $firstName; ?></li>
                                    <li class="list-group-item"><strong>Last Name:</strong> <?php echo $lastName; ?></li>
                                    <li class="list-group-item"><strong>Full Name:</strong> <?php echo $fullName; ?></li>
                                    <li class="list-group-item"><strong>Greeting:</strong> <?php echo $greeting; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Arithmetic Operations -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>5. Basic Arithmetic Operations</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        $a = 10;
                        $b = 3;
                        $addition = $a + $b;
                        $subtraction = $a - $b;
                        $multiplication = $a * $b;
                        $division = $a / $b;
                        $modulus = $a % $b;
                        $exponentiation = $a ** $b;
                        ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Variables:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>$a =</strong> <?php echo $a; ?></li>
                                    <li class="list-group-item"><strong>$b =</strong> <?php echo $b; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Operations:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Addition ($a + $b):</strong> <?php echo $addition; ?></li>
                                    <li class="list-group-item"><strong>Subtraction ($a - $b):</strong> <?php echo $subtraction; ?></li>
                                    <li class="list-group-item"><strong>Multiplication ($a * $b):</strong> <?php echo $multiplication; ?></li>
                                    <li class="list-group-item"><strong>Division ($a / $b):</strong> <?php echo number_format($division, 2); ?></li>
                                    <li class="list-group-item"><strong>Modulus ($a % $b):</strong> <?php echo $modulus; ?></li>
                                    <li class="list-group-item"><strong>Exponentiation ($a ** $b):</strong> <?php echo $exponentiation; ?></li>
                                </ul>
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