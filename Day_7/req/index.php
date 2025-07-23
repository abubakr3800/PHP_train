<?php
    function greet(){
        echo "Hello, World!<br>";
        echo __FUNCTION__ . "<br>";
        echo "__DIR__ = " . __DIR__ . "<br>";
        echo "__FILE__ = " . __FILE__ . "<br>";
        echo __LINE__ . "<br>";
    }
    greet();
    // require_once "db/config.php";
    include "header.php";
    include "footer.php";
?>
