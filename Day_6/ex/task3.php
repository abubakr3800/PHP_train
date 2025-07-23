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
            <div class="col-md-3">
                <?php
                session_start();
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $_SESSION["users"][] =[
                            "username" => $_POST["name"],
                            "email" => $_POST["email"],
                            "pass" => $_POST['pass']
                        ];

                    }
                ?>
                <form class="" action="" method="POST">
                    <div class="mb-3">
                        <input type="text" name="name" class="form-element w-100">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="email" class="form-element w-100">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="pass" class="form-element w-100">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-warning w-100">send</button>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <a href="./actions.php?act=clear" class="btn btn-primary ">clear session</a>
                        </div>
                        <div class="col">
                            <a href="./actions.php?act=last" class="btn btn-danger">remove element</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8">
                <?php
                    
                    if(isset($_SESSION["users"])){
                        echo "<table class='table table-dark table-striped table-hover'><tr class='p-3'><th>name</th><th>email</th></tr>";
                        foreach ($_SESSION['users'] as $i) {
                        echo "<tr class='p-3'><td>" . $i["username"] . "</td><td>" . $i["email"] . "</td></tr>";
                        }
                        echo "</table>";
                    } 

                ?>
            </div>
        </div>
    </div>    
</body>
</html>