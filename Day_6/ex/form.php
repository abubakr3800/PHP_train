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
            <div class="col-md-6">
                <form method="POST" action="./file-ex4.php" class="was-validated" enctype="multipart/form-data">        
                    <div class="input-group mb-3">
                        <input type="file" name="image" class="form-control is-valid"  id="inputGroupFile02" required>
                        <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04">send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>