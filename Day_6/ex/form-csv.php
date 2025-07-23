<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send grade</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mx-auto mt-5 d-flex justify-content-center">
            <div class="col-md-8">
                <form  method="POST" 
                       oninput="this.checkValidity() ? 
                                (this.sub.classList.add('btn-outline-success') , this.sub.classList.remove('btn-outline-danger') ) 
                                : (this.sub.classList.remove('btn-outline-success') , this.sub.classList.add('btn-outline-danger') )" 

                       action="./file-ex7.php" 
                       class="was-validated" 
                       enctype="multipart/form-data">

                    <div class="input-group mb-3">
                        <!-- 
                            Supported Common Attributes: 
                                autocomplete, 
                                list, 
                                maxlength,
                                minlength, 
                                pattern,
                                placeholder, 
                                readonly, 
                                required 
                                size

                            **********************
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" ==>"Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        -->
                            
                        <input minlength="5" maxlength="10" pattern="[a-zA-Zا-ي]{5,7}" placeholder="stuent name" name="name" id="inputGroupFile02" class="form-control is-valid" required>
                        <input type="number" name="grade" min='10' max='100' class="form-control is-valid w-50"  placeholder="stuent grade min=10 & max =100" id="inputGroupFile02" required>
                        <button class="btn btn-outline-danger" type="submit" id="sub">send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>