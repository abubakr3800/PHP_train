<?php 
	$con = mysqli_connect('localhost','root','');
    mysqli_select_db($con, 'training_system');

    $s = "SELECT * FROM `students`";
    $result = mysqli_query($con , $s);
    $num = mysqli_num_rows($result);

    // echo $num;

    echo "<ol>";
    while($allStudents = mysqli_fetch_assoc($result)) {
        echo "<li>" ;
        
            echo "<ul>";
                // echo "<li>" . ($allStudents["id"]) . "</li>";
                echo "<li>" . ($allStudents["name"]) . "</li>";
                echo "<li>" . ($allStudents["email"]) . "</li>";
                echo "<li>" . ($allStudents["phone"]) . "</li>";
                echo "<li><time datetime=" .($allStudents['date_of_birth']) . ">" .($allStudents['date_of_birth']) ."</time></li>";
            echo "</ul>" ;

        echo "</li>";
    }
    echo "</ol>";
?>