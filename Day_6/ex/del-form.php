<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mx-auto mt-5 d-flex justify-content-center">
            <?php
                $folder = "uploads/" . date("Y-m-d") . "/";
                $images = glob($folder . "*.{jpg,png,jpeg}", GLOB_BRACE);
                // echo "<pre>";
                // var_dump($images);
                // echo "</pre>";

                echo "<table class='table table-dark table-striped table-hover'><tr class='p-3'><th>#</th><th>image path</th><th>actions</th></tr>";
                foreach ($images as $i => $img) {
                    echo "<tr class='p-3'><td>" . ($i+1) . "</td><td> <img ismap src='$img' width=50 > <br> " . basename($img) . " </td><td><a class='btn btn-danger' href='./task8.php?delete=$img'>delete</a></td></tr>";
                }
                echo "</table>";
            ?>
        </div>
    </div>
</body>
</html>