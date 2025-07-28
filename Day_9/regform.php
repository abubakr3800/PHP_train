<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>reg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white p-4">
    
    <div class="container">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-6 col-12 p-5 mt-5 shadow rounded">

                <form method="POST" action="regtest.php" >
                    <div class="mb-3">
                        <label>name</label>
                        <input name="name" type="text" class="form-control is-valid" value="">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control is-valid" value="">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>