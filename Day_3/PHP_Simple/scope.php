<?php
    $globalVar = "I am a global variable"; // Access global variable
    function demonstrateScope() {
        global $globalVar; // Access global variable inside function
        $GLOBALS["localVar"] = "I am a local variable";
        global $localVar ;
        echo $globalVar . " <br><br> " ;// Can access global
        echo $localVar  . " <br><br> " ; // Can access local
    }

    demonstrateScope();

    function testGlobal() {
        echo $GLOBALS['globalVar'];
    }

    // Outside function
    echo $globalVar  . " <br><br> " ; // Can access global
    echo $localVar  . " <br><br> " ; // Cannot access local (error)
    testGlobal();
?>