<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
    <body class="bg-dark text-white">        
        <div class="container">
            <div class="row mt-5 d-flex justify-content-center">
                <div class="col-md-8">
                    <?php
                        // التحقق من امتداد الصورة ونقلها لمجلد حسب التاريخ
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $folder = 'uploads/' . date('Y-m-d') . '/';
                            if (!file_exists($folder)) mkdir($folder, 0777, true);
                            
                            $fileName = basename($_FILES['image']['name']);
                            // $target = $folder . time() . "_" . $fileName;
                            echo $fileName . "<br>";
                            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                            $new_name = uniqid('img_' , true) . '.' . $ext;
                            $target = $folder . $new_name;
                            // echo $new_name;
                            
                            $allowed = ['image/jpeg', 'image/png'];
                            if (in_array($_FILES['image']['type'], $allowed)) {
                                
                                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                                echo "
                                <div class='alert alert-success' role='alert'>
                                    Uploaded to $target
                                </div>
                                ";
                            } else {
                                echo "
                                <div class='alert alert-danger' role=alert>
                                    invalid type of image check it out!
                                </div>
                                ";
                            }
                        }
                    ?>                    
                </div>
            </div>
        </div>        
    </body>
</html>

