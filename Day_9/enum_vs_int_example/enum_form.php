<?php
$conn = mysqli_connect("localhost", "root", "", "test");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $stmt = $conn->prepare("INSERT INTO users_enum (name, gender) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $gender);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM users_enum");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ENUM Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2 class="mb-4">تسجيل مستخدم (ENUM)</h2>
    <form method="POST" class="mb-4">
        <input type="text" name="name" placeholder="الاسم" required class="form-control mb-2">
        <select name="gender" class="form-select mb-2">
            <option value="male">ذكر</option>
            <option value="female">أنثى</option>
            <option value="other" selected>آخر</option>
        </select>
        <button type="submit" class="btn btn-primary">تسجيل</button>
    </form>

    <h4>قائمة المستخدمين</h4>
    <table class="table table-bordered">
        <thead><tr><th>الرقم</th><th>الاسم</th><th>النوع</th></tr></thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= $row['gender'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>