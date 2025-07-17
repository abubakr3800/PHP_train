<?php
    $colors = ['red' , 'green' , 'blue'];
    $user = ['name' => "ahmed" , "age" => 25 , "city" => "Giza" ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success">

    <div class="container">
        <div class="row mt-5">
            <div class="list-group">
                <?php
                    foreach($user as $k => $value){
                        echo '<a href="#" class="list-group-item list-group-item-action">' . "<p class='text-primary d-inline'>$k " . " is : </p>" . $value .'</a>';
                    }
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr >
                        <th scope="col">key</th>
                        <th scope="col">value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($user as $k => $value){
                        echo "
                            <tr>
                                <th scope='row'> $k  </th>
                                <td> $value </td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 