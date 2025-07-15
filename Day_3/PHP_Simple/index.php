<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Simple Syntax Examples</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .section { margin: 20px 0; padding: 15px; border-left: 4px solid #007bff; background: #f8f9fa; }
        .code { background: #e9ecef; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .output { background: #d4edda; padding: 10px; border-radius: 4px; margin: 10px 0; overflow: scroll;}
        h2 { color: #007bff; }
        h3 { color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP Simple Syntax Examples for Beginners</h1>
        
        <?php
        // ============================================
        // 1. BASIC PHP SYNTAX
        // ============================================
        echo "<div class='section'>";
        echo "<h2>1. Basic PHP Syntax</h2>";
        echo "<p>PHP code is enclosed in &lt;?php ?&gt; tags</p>";
        echo "<div class='code'>";
        echo "&lt;?php<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;echo 'Hello World!';<br>";
        echo "?&gt;";
        echo "</div>";
        echo "<div class='output'>";
        echo "<strong>Output:</strong> Hello World!";
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 2. VARIABLES
        // ============================================
        echo "<div class='section'>";
        echo "<h2>2. Variables</h2>";
        echo "<p>Variables in PHP start with $ symbol</p>";
        
        // String variable
        $name = "Ahmed Abubakr";
        $age = 25;
        $height = 5.8;
        $isStudent = true;
        
        echo "<div class='code'>";
        echo "\$name = \"John Doe\";<br>";
        echo "\$age = 25;<br>";
        echo "\$height = 5.8;<br>";
        echo "\$isStudent = true;";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Output:</strong><br>";
        echo "Name: " . $name . "<br>";
        echo "Age: " . $age . "<br>";
        echo "Height: " . $height . " feet<br>";
        echo "Is Student: " . ($isStudent ? "Yes" : "No");
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 3. DATA TYPES AND GETTYPE() FUNCTION
        // ============================================
        echo "<div class='section'>";
        echo "<h2>3. Data Types and gettype() Function</h2>";
        echo "<p>PHP has different data types. Use gettype() to check variable type</p>";
        
        // Different data types
        $stringVar = "Hello World";
        $integerVar = 42;
        $floatVar = 3.14;
        $booleanVar = true;
        $arrayVar = array(1, 2, 3);
        $nullVar = null;
        
        echo "<div class='code'>";
        echo "// Different data types<br>";
        echo "\$stringVar = \"Hello World\";<br>";
        echo "\$integerVar = 42;<br>";
        echo "\$floatVar = 3.14;<br>";
        echo "\$booleanVar = true;<br>";
        echo "\$arrayVar = array(1, 2, 3);<br>";
        echo "\$nullVar = null;<br><br>";
        echo "// Using gettype() function<br>";
        echo "gettype(\$variable);";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Data Types:</strong><br>";
        echo "String: " . $stringVar . " (Type: " . gettype($stringVar) . ")<br>";
        echo "Integer: " . $integerVar . " (Type: " . gettype($integerVar) . ")<br>";
        echo "Float: " . $floatVar . " (Type: " . gettype($floatVar) . ")<br>";
        echo "Boolean: " . ($booleanVar ? "true" : "false") . " (Type: " . gettype($booleanVar) . ")<br>";
        echo "Array: [" . implode(", ", $arrayVar) . "] (Type: " . gettype($arrayVar) . ")<br>";
        echo "Null: " . (is_null($nullVar) ? "null" : "not null") . " (Type: " . gettype($nullVar) . ")";
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 4. FUNCTIONS - DEFINITION AND USES
        // ============================================
        echo "<div class='section'>";
        echo "<h2>4. Functions - Definition and Uses</h2>";
        echo "<p>Functions are reusable blocks of code that perform specific tasks</p>";
        
        // Function definition examples
        function simpleFunction() {
            return "Hello from a simple function!";
        }
        
        function calculateArea($length, $width) {
            return $length * $width;
        }
        
        function formatName($firstName, $lastName) {
            return ucfirst($firstName) . " " . ucfirst($lastName);
        }
        
        function isEven($number) {
            return $number % 2 == 0;
        }
        
        echo "<div class='code'>";
        echo "// Function Definition Syntax:<br>";
        echo "function functionName(\$parameter1, \$parameter2) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;// Function body<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \$result;<br>";
        echo "}<br><br>";
        echo "// Example functions:<br>";
        echo "function simpleFunction() {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \"Hello from a simple function!\";<br>";
        echo "}<br><br>";
        echo "function calculateArea(\$length, \$width) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \$length * \$width;<br>";
        echo "}<br><br>";
        echo "function formatName(\$firstName, \$lastName) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return ucfirst(\$firstName) . \" \" . ucfirst(\$lastName);<br>";
        echo "}";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Function Examples:</strong><br>";
        echo "Simple function: " . simpleFunction() . "<br>";
        echo "Area calculation (5x3): " . calculateArea(5, 3) . " square units<br>";
        echo "Formatted name: " . formatName("john", "doe") . "<br>";
        echo "Is 10 even? " . (isEven(10) ? "Yes" : "No") . "<br>";
        echo "Is 7 even? " . (isEven(7) ? "Yes" : "No");
        echo "</div>";
        
        // Function uses and benefits
        echo "<div class='code'>";
        echo "// Uses of Functions:<br>";
        echo "1. Code Reusability - Write once, use many times<br>";
        echo "2. Organization - Group related code together<br>";
        echo "3. Maintainability - Easy to update and fix<br>";
        echo "4. Readability - Make code easier to understand<br>";
        echo "5. Testing - Test individual pieces of code<br>";
        echo "6. Modularity - Break complex tasks into smaller parts";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Function Benefits:</strong><br>";
        echo "✅ <strong>Reusability:</strong> Use the same function multiple times<br>";
        echo "✅ <strong>Organization:</strong> Keep related code together<br>";
        echo "✅ <strong>Maintainability:</strong> Update code in one place<br>";
        echo "✅ <strong>Readability:</strong> Make code self-documenting<br>";
        echo "✅ <strong>Testing:</strong> Test functions independently<br>";
        echo "✅ <strong>Modularity:</strong> Break complex tasks into simple functions";
        echo "</div>";
        
        // Function types
        echo "<div class='code'>";
        echo "// Types of Functions:<br>";
        echo "1. Simple functions - No parameters, no return<br>";
        echo "2. Parameter functions - Accept input values<br>";
        echo "3. Return functions - Send back results<br>";
        echo "4. Built-in functions - PHP's built-in functions<br>";
        echo "5. Anonymous functions - Functions without names";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Function Types:</strong><br>";
        echo "🔹 <strong>Simple:</strong> function sayHello() { echo \"Hello\"; }<br>";
        echo "🔹 <strong>With Parameters:</strong> function greet(\$name) { return \"Hello \$name\"; }<br>";
        echo "🔹 <strong>With Return:</strong> function add(\$a, \$b) { return \$a + \$b; }<br>";
        echo "🔹 <strong>Built-in:</strong> strlen(), count(), array_merge()<br>";
        echo "🔹 <strong>Anonymous:</strong> \$func = function(\$x) { return \$x * 2; };";
        echo "</div>";
        
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 5. VARIABLE SCOPES
        // ============================================
        echo "<div class='section'>";
        echo "<h2>4. Variable Scopes</h2>";
        echo "<p>Understanding variable scope in PHP - global, local, and function scope</p>";
        
        // Global variable
        $globalVar = "I am a global variable";
        
        // Function to demonstrate scope
        function demonstrateScope() {
            global $globalVar; // Access global variable
            $localVar = "I am a local variable";
            $functionVar = "I am a function variable";
            
            echo "<div class='code'>";
            echo "function demonstrateScope() {<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;global \$globalVar; // Access global variable<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;\$localVar = \"I am a local variable\";<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;echo \$globalVar; // Can access global<br>";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;echo \$localVar; // Can access local<br>";
            echo "}<br><br>";
            echo "// Outside function<br>";
            echo "echo \$globalVar; // Can access global<br>";
            echo "echo \$localVar; // Cannot access local (error)";
            echo "</div>";
            
            echo "<div class='output'>";
            echo "<strong>Inside Function:</strong><br>";
            echo "Global variable: " . $globalVar . "<br>";
            echo "Local variable: " . $localVar . "<br>";
            echo "Function variable: " . $functionVar;
            echo "</div>";
        }
        
        // Call the function
        demonstrateScope();
        
        echo "<div class='output'>";
        echo "<strong>Outside Function:</strong><br>";
        echo "Global variable: " . $globalVar . "<br>";
        echo "Local variable: " . (isset($localVar) ? $localVar : "Not accessible") . "<br>";
        echo "Function variable: " . (isset($functionVar) ? $functionVar : "Not accessible");
        echo "</div>";
        
        // Demonstrate static variables
        function counter() {
            static $count = 0;
            $count++;
            return $count;
        }
        
        echo "<div class='code'>";
        echo "// Static variable example<br>";
        echo "function counter() {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;static \$count = 0;<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\$count++;<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \$count;<br>";
        echo "}";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Static Variable Counter:</strong><br>";
        echo "First call: " . counter() . "<br>";
        echo "Second call: " . counter() . "<br>";
        echo "Third call: " . counter();
        echo "</div>";
        
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 6. ARRAYS
        // ============================================
        echo "<div class='section'>";
        echo "<h2>6. Arrays</h2>";
        echo "<p>Arrays can store multiple values</p>";
        
        // Indexed array
        $fruits = array("Apple", "Banana", "Orange");
        // Alternative syntax (PHP 5.4+)
        $colors = ["Red", "Green", "Blue"];
        
        // Associative array
        $person = array(
            "name" => "Jane Smith",
            "age" => 30,
            "city" => "New York"
        );
        
        echo "<div class='code'>";
        echo "// Indexed array<br>";
        echo "\$fruits = array(\"Apple\", \"Banana\", \"Orange\");<br><br>";
        echo "// Associative array<br>";
        echo "\$person = array(<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\"name\" => \"Jane Smith\",<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\"age\" => 30,<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\"city\" => \"New York\"<br>";
        echo ");";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Indexed Array:</strong> ";
        echo implode(", ", $fruits) . "<br>";
        echo "<strong>Associative Array:</strong><br>";
        echo "Name: " . $person["name"] . "<br>";
        echo "Age: " . $person["age"] . "<br>";
        echo "City: " . $person["city"];
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 7. LOOPS
        // ============================================
        echo "<div class='section'>";
        echo "<h2>7. Loops</h2>";
        echo "<p>Different types of loops in PHP</p>";
        
        echo "<div class='code'>";
        echo "// For loop<br>";
        echo "for (\$i = 1; \$i <= 5; \$i++) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;echo \$i . \" \";<br>";
        echo "}<br><br>";
        echo "// Foreach loop<br>";
        echo "foreach (\$fruits as \$fruit) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;echo \$fruit . \" \";<br>";
        echo "}";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>For Loop Output:</strong> ";
        for ($i = 1; $i <= 5; $i++) {
            echo $i . " ";
        }
        echo "<br><strong>Foreach Loop Output:</strong> ";
        foreach ($fruits as $fruit) {
            echo $fruit . " ";
        }
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 8. FUNCTIONS
        // ============================================
        echo "<div class='section'>";
        echo "<h2>8. Functions</h2>";
        echo "<p>Creating and using functions</p>";
        
        // Function definition
        function greet($name) {
            return "Hello, " . $name . "!";
        }
        
        function add($a, $b) {
            return $a + $b;
        }
        
        echo "<div class='code'>";
        echo "function greet(\$name) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \"Hello, \" . \$name . \"!\";<br>";
        echo "}<br><br>";
        echo "function add(\$a, \$b) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;return \$a + \$b;<br>";
        echo "}";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Function Output:</strong><br>";
        echo greet("Alice") . "<br>";
        echo "5 + 3 = " . add(5, 3);
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 9. CONDITIONAL STATEMENTS
        // ============================================
        echo "<div class='section'>";
        echo "<h2>9. Conditional Statements</h2>";
        echo "<p>Using if, else, and switch statements</p>";
        
        $score = 85;
        $grade = "";
        
        if ($score >= 90) {
            $grade = "A";
        } elseif ($score >= 80) {
            $grade = "B";
        } elseif ($score >= 70) {
            $grade = "C";
        } else {
            $grade = "F";
        }
        
        echo "<div class='code'>";
        echo "if (\$score >= 90) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\$grade = \"A\";<br>";
        echo "} elseif (\$score >= 80) {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\$grade = \"B\";<br>";
        echo "} else {<br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;\$grade = \"F\";<br>";
        echo "}";
        echo "</div>";
        
        echo "<div class='output'>";
        echo "<strong>Conditional Output:</strong><br>";
        echo "Score: " . $score . "<br>";
        echo "Grade: " . $grade;
        echo "</div>";
        echo "</div>";
        ?>

        <?php
        // ============================================
        // 10. HTML AND PHP INTEGRATION
        // ============================================
        echo "<div class='section'>";
        echo "<h2>10. HTML and PHP Integration</h2>";
        echo "<p>Mixing HTML and PHP code</p>";
        
        $currentTime = date("Y-m-d H:i:s");
        $dayOfWeek = date("l");
        ?>
        
        <div class="code">
            &lt;?php<br>
            &nbsp;&nbsp;&nbsp;&nbsp;$currentTime = date("Y-m-d H:i:s");<br>
            &nbsp;&nbsp;&nbsp;&nbsp;$dayOfWeek = date("l");<br>
            ?&gt;<br><br>
            &lt;p&gt;Current time: &lt;?php echo $currentTime; ?&gt;&lt;/p&gt;<br>
            &lt;p&gt;Today is: &lt;?php echo $dayOfWeek; ?&gt;&lt;/p&gt;
        </div>
        
        <div class="output">
            <strong>Current Output:</strong><br>
            <p>Current time: <?php echo $currentTime; ?></p>
            <p>Today is: <?php echo $dayOfWeek; ?></p>
        </div>
        </div>

        <?php
        // ============================================
        // 11. SUPER GLOBALS
        // ============================================
        echo "<div class='section'>";
        echo "<h2>11. Super Globals</h2>";
        echo "<p>PHP provides several super global variables</p>";
        
        echo "<div class='code'>";
        echo "\$_SERVER['PHP_SELF'] - Current script name<br>";
        echo "\$_SERVER['SERVER_NAME'] - Server name<br>";
        echo "\$_GET - GET request data<br>";
        echo "\$_POST - POST request data<br>";
        echo "\$_SESSION - Session data<br>";
        echo "\$_COOKIE - Cookie data";
        echo "</div>";
        
            echo "<div class='output'> 
                    <strong>Server Information:</strong><br> 
                        Script Name: " . $_SERVER['PHP_SELF'] . "<br>
                        Server Name: " . $_SERVER['SERVER_NAME'] . "<br>
                        Request Method: " . $_SERVER['REQUEST_METHOD'];
            echo "</div>";
        echo "</div>";
        ?>

        <div class="section">
            <h2>12. Next Steps</h2>
            <p>Now that you understand basic PHP syntax, you can:</p>
            <ul>
                <li>Create dynamic web pages</li>
                <li>Process forms</li>
                <li>Connect to databases</li>
                <li>Build web applications</li>
                <li>Learn PHP frameworks like Laravel or CodeIgniter</li>
            </ul>
        </div>
    </div>
</body>
</html> 