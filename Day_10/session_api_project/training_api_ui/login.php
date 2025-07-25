<?php
header("Content-Type: application/json");
include "../db.php"; // الاتصال بقاعدة البيانات

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Missing email or password"]);
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id, name, pass FROM admin WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $row['pass'])) {
        // توليد توكن بسيط (في نسخة production استخدم JWT أو UUID + تخزين في DB)
        // $token = bin2hex(random_bytes(16));
            
        //بدل ما تولد التوكن عشوائي بس، ممكن تستخدم حاجة زي:
        $token = hash('sha256', $email . 'secret');
        setcookie("token", $token, time() + 86400, "/"); // صالح ليوم كامل (86400 ثانية)

        // تخزين التوكن في login_logs أو جدول tokens (اختياري للتأكد لاحقًا)
        mysqli_query($conn, "INSERT INTO login_logs (user_email, ip_address) VALUES ('$email', '{$_SERVER['REMOTE_ADDR']}')");

        echo json_encode([
            "status" => "success",
            "token" => $token,
            "name" => $row['name'],
            "user_id" => $row['id']
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["status" => "error", "message" => "Wrong password"]);
    }
} else {
    http_response_code(404);
    echo json_encode(["status" => "error", "message" => "User not found"]);
}
?>
