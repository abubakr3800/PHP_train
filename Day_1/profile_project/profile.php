<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}
include 'config.php';
include 'header.php';
?>

<h2>مرحباً، <?= htmlspecialchars($_SESSION['username']); ?></h2>
<p>الوظيفة: <?= $_SESSION['job']; ?> (<?= $_SESSION['age'] > 30 ? 'خبير' : ($_SESSION['age'] < 18 ? 'صغير السن' : 'بالغ'); ?>)</p>

<?php
if ($_SESSION['job'] === "student") {
  echo "<p>مرحباً طالب المستقبل</p>";
} elseif ($_SESSION['job'] === "developer") {
  echo "<p>أهلاً بالمبرمج الخارق</p>";
} else {
  echo "<p>أهلاً بك في الموقع</p>";
}
?>

<h3>مهارات مقترحة:</h3>
<?php include 'skills.php'; ?>

<p><a href="index.php">تعديل البيانات</a> | <a href="logout.php">تسجيل الخروج</a></p>
<?php include 'footer.php'; ?>
