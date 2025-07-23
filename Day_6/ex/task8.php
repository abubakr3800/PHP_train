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
                <div class="col-md-8">
                    <?php
                        if (isset($_GET['delete'])) {
                            $target = $_GET['delete'];
                            if (file_exists($target)) {
                                unlink($target);
                                echo "
                                <div class='alert alert-success' role='alert'>
                                    Deleted the image in path:- $target <a href='./del-form.php' class='alert-link'>go to images table</a>. " . ucfirst('and delte more if you want') . ".
                                </div>
                                ";
                            }else{
                                echo "
                                <div class='alert alert-warning' role='alert'>
                                    " . ucfirst('file not found may be delted already') . " <a href='./del-form.php' class='alert-link'>go to images table</a>. Give it a click if you like.
                                </div>
                                ";
                            }
                        }else {
                            echo "
                            <div class='alert alert-danger' role='alert'>
                                No Image Sent To This Page <a href='./del-form.php' class='alert-link'>go to images table</a>. Give it a click if you like.
                            </div>
                            ";
                        }
                    ?>       
                </div>
            </div>
        </div>        
    </body>
</html>

