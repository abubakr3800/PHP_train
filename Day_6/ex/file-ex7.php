<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['grade'])) {
    $name = $_POST['name'];
    $grade = $_POST['grade'];

    $folder = "exports/" . date("Y-m-d");
    if (!file_exists($folder)) mkdir($folder, 0777, true);

    $file = fopen("$folder/students.csv", "a");
    $students = [
        "name" => $name,
        "grade" => $grade
    ];
    fputcsv($file, $students );
    fclose($file);
    echo "Saved to CSV.";

    }else{
        echo "missing values or wrong method" ;
    }

    $folder = "uploads/" . date("Y-m-d") . "/";
    $files = glob($folder . "*.*");

    foreach ($files as $f) {
    $info = pathinfo($f);
        echo "<p>";
        echo "<strong>Name:</strong> " . basename($f) . " | ";
        echo "<strong>Type:</strong> " . $info['extension'] . " | ";
        echo "<strong>Size:</strong> " . filesize($f) . " bytes";
        echo "</p>";
    }