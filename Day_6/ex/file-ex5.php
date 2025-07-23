<?php
    $folder = "uploads/" . date("Y-m-d") . "/";
    $images = glob($folder . "*.{jpg}", GLOB_BRACE);
    echo "<pre>";
        var_dump($images);
    echo "</pre>";