<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Log File in Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8">
                <?php
                    $lines = file("logs/visits.txt");
                    echo "<table class='table table-dark table-striped table-hover'><tr class='p-3'><th>#</th><th>Entry Label</th><th>Entry Details</th></tr>";
                    foreach ($lines as $i => $line) {
                    echo "<tr class='p-3'><td>" . ($i+1) . "</td><td>" . explode('at' , $line)[0] . "</td><td>" .explode('at' , $line)[1] . "</td></tr>";
                    }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>    
</body>
</html>