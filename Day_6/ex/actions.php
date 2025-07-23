<?php
session_start();
if(isset($_GET['act'])){
    if($_GET['act'] =="clear"){
        session_unset();
        session_destroy();
        header("Location: task3.php");
    }elseif ($_GET['act'] =="last") {
        array_pop($_SESSION['users'])  ;
        header("Location: task3.php");
    }else{
        echo "Invalid action element";
    }
    
}else{
    echo "Invalid action";
}