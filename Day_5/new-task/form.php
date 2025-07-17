<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تخزين مجموعة صور</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container pt-5">
        <?php
            $allowedExt = ["jpg", "jpeg"];
            $allowedTypes = ["image", "wave"];
            $maxSize = 4 * 1024 * 1024; // 4 MB
            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_FILES['images'])) {
                    foreach ($_FILES['images']['name'] as $key => $name) {
                        $fileTmp  = $_FILES['images']['tmp_name'][$key];
                        $fileSize = $_FILES['images']['size'][$key];
                        $fileType = mime_content_type($fileTmp);
                        $fileExt  = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                        // التحقق من الامتداد
                        if (!in_array($fileExt, $allowedExt)) {
                            $errors[] = " ملف ($name): الامتداد غير مسموح ($fileExt)";
                        }

                        // التحقق من الـ MIME Type
                        $typeMain = explode("/", $fileType)[0]; // image مثلا
                        if (!in_array($typeMain, $allowedTypes)) {
                            $errors[] = " ملف ($name): النوع غير مسموح ($fileType)";
                        }

                        // التحقق من الحجم
                        if ($fileSize > $maxSize) {
                            $errors[] = "ملف ($name): الحجم أكبر من 4 ميجابايت";
                        }
                    }

                    // في حالة وجود أخطاء
                    if (!empty($errors)) {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo "<strong>فشل رفع الصور:</strong><br>";
                        foreach ($errors as $err) {
                            echo "$err<br>";
                        }
                        echo '</div>';
                    } else {
                        // رفع الملفات
                        foreach ($_FILES['images']['name'] as $key => $name) {
                            $tmpName = $_FILES['images']['tmp_name'][$key];
                            $new_name = uniqid('img_' , true) . '.' . $fileExt;
                            move_uploaded_file( $tmpName, "uploads/$new_name");

                            // move_uploaded_file($tmpName, "uploads/" . $name);
                        }
                        echo '<div class="alert alert-success" role="alert">
                                تم رفع جميع الصور بنجاح.
                            </div>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>
