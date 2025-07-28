<?php include "db.php"; 
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
    ?>
        <ul>
            <li><?= $row['id'] ?></li>
            <li><?= $row['name'] ?></li>
            <li><?= $row['email'] ?></li>
            <li><?= $row['phone'] ?></li>
            <li><?= $row['date_of_birth'] ?></li>
        </ul>
    <?php
        endwhile;
    else:
        echo "No students found";
    endif;
?>