<?php 
	$con = mysqli_connect('localhost','root','');
    mysqli_select_db($con, 'training_system');

    $s = "SELECT * FROM `students`";
    $result = mysqli_query($con , $s);
    $num = mysqli_num_rows($result);

    // echo $num;

    while($allStudents = mysqli_fetch_assoc($result)) {
            echo "<pre>";
                var_dump($allStudents);
            echo "</pre>" ;
    }
?>