<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
    <body class="bg-dark">        
        <div class="container">
            <div class="row mt-5 d-flex justify-content-center">
                                     
                    <?php
                        $folder = "uploads/" . date("Y-m-d") . "/";
                        $images = glob($folder . "*.{jpg,png,jpeg}", GLOB_BRACE);

                        foreach ($images as $img) {
                        echo "<div class='col-md-2'><div class='card mb-3'>";
                        echo "<img src='$img' class='card-img-top'>";
                        echo "</div></div>";
                        }
                    ?>

            </div>
        </div>        
    </body>
</html>