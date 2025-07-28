<?php
function check_token() {
    // لو حابب تحفظ التوكنات في جدول خاص: SELECT * FROM tokens WHERE token = ?
    // هنا نستخدم login_logs فقط كتمثيل بسيط
    include "db.php";

    $headers = getallheaders();
    $token = $headers['Authorization'] ?? '';

    if (!$token) {
        http_response_code(401);
        echo json_encode(["status" => "unauthorized", "message" => "Missing token"]);
        exit;
    }

    // كحل مؤقت: التحقق إن التوكن موجود في آخر سجل دخول
    $stmt = mysqli_prepare($conn, "SELECT * FROM login_logs ORDER BY login_time DESC LIMIT 50");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $found = false;
    while ($row = mysqli_fetch_assoc($result)) {
        if (hash('sha256', $row['user_email'] . 'secret') === $token) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        http_response_code(403);
        echo json_encode(["status" => "forbidden", "message" => "Invalid token"]);
        exit;
    }

    // ✅ passed
}
?>
