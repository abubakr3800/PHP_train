<?php
$globalVar = "I am a global variable"; // Access global variable

function demonstrateScope() {
    global $globalVar; // Access global variable inside function
    $localVar = "I am a local variable";
    echo $globalVar . " <br><br> " ;// Can access global
    echo $localVar  . " <br><br> " ; // Can access local
}

demonstrateScope();

// Outside function
echo $globalVar  . " <br><br> " ; // Can access global
echo $localVar  . " <br><br> " ; // Cannot access local (error)
?>