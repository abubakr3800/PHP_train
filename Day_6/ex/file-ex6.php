<?php
    if (isset($_GET['delete'])) {
        $target = $_GET['delete'];
        if (file_exists($target)) {
            unlink($target);
            echo "Deleted $target";
        }else{
            echo "File not found";
        }
    }else {
        echo "please send file name in url";
    }