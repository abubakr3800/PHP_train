<?php
$conn = mysqli_connect("localhost", "root", "", "test");

$gender_map = [
    0 => 'ذكر',
    1 => 'أنثى',
    2 => 'آخر'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = (int)$_POST['gender'];
    $stmt = $conn->prepare("INSERT INTO users_int (name, gender) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $gender);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM users_int");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TINYINT Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h2 class="mb-4">تسجيل مستخدم (TINYINT)</h2>
    <form method="POST" class="mb-4">
        <input type="text" name="name" placeholder="الاسم" required class="form-control mb-2">
        <select name="gender" class="form-select mb-2">
            <option value="0">ذكر</option>
            <option value="1">أنثى</option>
            <option value="2" selected>آخر</option>
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
                <td><?= $gender_map[$row['gender']] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>