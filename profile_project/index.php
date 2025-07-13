<?php include 'header.php'; ?>
<form method="POST" action="process.php">
  <label>الاسم:</label><br>
  <input type="text" name="username" required><br>

  <label>العمر:</label><br>
  <input type="number" name="age" required><br>

  <label>الدولة:</label><br>
  <input type="text" name="country" required><br>

  <label>المهنة:</label><br>
  <input type="text" name="job" required><br><br>

  <button type="submit">إنشاء الملف الشخصي</button>
</form>
<?php include 'footer.php'; ?>
