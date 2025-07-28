## Day 12: Advanced SQL + Security + OOP (6h)

### 🔐 APIs + MySQL + OOP Protection

---

## Slide 1: Overview – Why Advanced SQL?

- حتى الآن أنشأنا APIs تقوم بالعمليات الأربعة (CRUD):\
  ✅ **GET** – جلب البيانات\
  ✅ **POST** – إضافة بيانات\
  ✅ **PUT** – تعديل\
  ✅ **DELETE** – حذف

- اليوم سنتعمق في:

  - **Joins** – لربط الجداول
  - **Subqueries** – لاستعلام داخل استعلام
  - **SQL Injection** – تهديد شائع وكيف نحمي أنفسنا منه
  - **XSS Prevention** – حماية المستخدم النهائي
  - **API Security Best Practices**
  - **استخدام مبادئ OOP في بناء APIs**

📌 **ربط المفاهيم بمشروع Day 10:**

- الجداول المستخدمة: `students`, `courses`, `enrollments`, `admin`
- نقوم اليوم بكتابة استعلامات وربطهم بواجهة الـ API الآمنة باستخدام كلاس `Student`, `Course`, `Enrollment`

---

## Slide 2: CRUD with API & SQL Mapping

| HTTP Method | SQL Equivalent | مثال تطبيقي     |
| ----------- | -------------- | --------------- |
| GET         | SELECT         | get.php?id=3    |
| POST        | INSERT         | post.php        |
| PUT         | UPDATE         | put.php?id=2    |
| DELETE      | DELETE         | delete.php?id=7 |

🤩 **مثال عملي (Courses API + OOP):**

```php
require_once "Course.php";
$course = new Course($conn);
$data = $course->getById($_GET['id']);
echo json_encode($data);
```

---

## Slide 2.5: إعداد الاتصال بـ MySQL (OOP)

للاتصال بقاعدة البيانات نستخدم `mysqli` داخل كلاس خاص مثل `Database.php`

```php
class Database {
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "school";
  private $port = 3306;
  public $conn;

  public function connect() {
    $this->conn = new mysqli(
      $this->host,
      $this->username,
      $this->password,
      $this->dbname,
      $this->port
    );

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
}
```

🔌 **ملاحظة:**

- اسم المستخدم الافتراضي: `root`
- كلمة المرور الافتراضية: فارغة
- السيرفر: `localhost`
- البورت: `3306`

---

## Slide 2.6: استخدام Trait للاتصال بقاعدة البيانات

📦 بدلاً من تكرار الاتصال في أكثر من كلاس، يمكن استخدام trait يحتوي على كود الاتصال.

```php
trait MySQLConnection {
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "school";
  private $port = 3306;
  public $conn;

  public function connect() {
    $this->conn = new mysqli(
      $this->host,
      $this->username,
      $this->password,
      $this->dbname,
      $this->port
    );
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
}
```

ثم في كلاس `Database`:
```php
class Database {
  use MySQLConnection;
}
```

---

## Slide 2.7: أيهما أفضل؟ `new mysqli()` أم كلاس `Database`

| المقارنة                       | `new mysqli()` مباشر | `Database` Class/trait |
|-------------------------------|------------------------|-------------------------|
| سهولة وسرعة                  | ✅ نعم                 | ❌ معقد للمبتدئين       |
| قابلية التوسيع               | ❌ صعب                 | ✅ سهل                  |
| التنظيم                       | ❌ غير منظم            | ✅ منظم                 |
| التكرار                       | ❌ مكرر                | ✅ كود واحد موحد         |
| مناسب للمشاريع الصغيرة       | ✅ جداً                | ❌ زيادة غير ضرورية     |
| مناسب للمشاريع المتوسطة/كبير | ❌ غير كافي            | ✅ الأفضل               |

🎯 **الاستنتاج:**
- استخدم `new mysqli()` في المشاريع الصغيرة.
- استخدم كلاس `Database` مع trait في المشاريع المتوسطة أو التدريبية لتنظيم الكود.

---

## Slide 3: SQL JOIN – Why?

🔗 `JOIN` يربط بيانات من جداول متعددة.

### ✅ Example 1:

```sql
SELECT s.name, c.title
FROM students s
INNER JOIN enrollments e ON s.id = e.student_id
INNER JOIN courses c ON c.id = e.course_id;
```

📌 *فائدة*: عرض الطالب + الكورس المشترك

### 🤩 Example 2:

```sql
SELECT s.name, COUNT(e.course_id) AS total_courses
FROM students s
LEFT JOIN enrollments e ON s.id = e.student_id
GROUP BY s.id;
```

### 👡 Task 1:

اكتب استعلام يُظهر `title` لكل كورس وعدد الطلاب المسجلين فيه.

**الحل:**

```sql
SELECT c.title, COUNT(e.student_id) AS total_students
FROM courses c
LEFT JOIN enrollments e ON c.id = e.course_id
GROUP BY c.id;
```

---

## Slide 4: Subqueries

🗖️ `Subquery = Query inside another query`

### ✅ Example 1:

```sql
SELECT name FROM students
WHERE id IN (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  HAVING COUNT(*) > 1
);
```

### ✅ Example 2:

```sql
SELECT name FROM students
WHERE id NOT IN (SELECT student_id FROM enrollments);
```

### 👡 Task 2:

اعرض اسم الطالب اللي مسجل في أكثر كورسات من الباقي.

**الحل:**

```sql
SELECT name FROM students
WHERE id = (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  ORDER BY COUNT(*) DESC
  LIMIT 1
);
```

---

## Slide 5: SQL Injection – المشكلة 👾

❌ خطأ شائع:

```php
$sql = "SELECT * FROM users WHERE email = '$email'";
```

📌 يسمح بهجوم مثل `' OR 1=1 --`

✅ الحل: `Prepared Statements`

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
```

🔁 **OOP حماية أفضل:**

```php
class Student {
  private $conn;
  function __construct($db) {
    $this->conn = $db;
  }
  function getByEmail($email) {
    $stmt = $this->conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
```

### 👡 Task 3:

API اسمها `check_student.php` تأخذ email وتعيد بيانات الطالب باستخدام `Student` class

---

## Slide 6: XSS – Cross Site Scripting

⚠️ خطر من HTML غير مصفي. ❌ خطأ:

```php
echo $_GET['name'];
```

✅ حماية:

```php
echo htmlspecialchars($_GET['name']);
```

---

## Slide 7: Secure API Example: get.php

استخدم `prepare()` + `htmlspecialchars()` ضمن كلاس `Student`

---

## Slide 8: Compare – Secure vs Insecure

| Feature             | Secure Version           | Insecure Version             |
| ------------------- | ------------------------ | ---------------------------- |
| Input Validation    | ✅ `is_numeric()`         | ❌ Direct in query            |
| Prepared Statements | ✅ `prepare + bind_param` | ❌ Variable inside SQL string |
| XSS Output Sanitize | ✅ `htmlspecialchars()`   | ❌ Raw echo of user input     |
| Error Handling      | ✅ Controlled messages    | ❌ Exposed MySQL errors       |
| OOP Abstraction     | ✅ `Student::getById()`   | ❌ Raw query in API           |

---

## Slide 9: Advanced Task: Courses per Student (OOP)

👡 Task 5: اكتب كلاس `Enrollment` يحتوي دالة تعرض اسم الطالب وعدد الكورسات المسجل بها باستخدام JOIN

---

## Slide 10: Bonus – Global Protection Function

```php
function clean($val) {
  return htmlspecialchars(trim($val));
}
```

📌 استخدمها في كلاس `BaseModel` ليتم وراثتها

---

## Slide 11: Unit Testing في PHP

### ✅ ما هو؟
اختبار وحدة الكود – مثل دالة أو كلاس – بشكل منعزل للتأكد أنها تعمل صح.

### 🛠️ الأداة المستخدمة: PHPUnit
- يتم تثبيته عبر Composer
- نكتب اختبارات في مجلد `tests/`

### مثال بسيط:
```php
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
  public function testGetById() {
    $student = new Student($conn);
    $result = $student->getById(1);
    $this->assertEquals("Ahmed", $result['name']);
  }
}
```

### ✅ الفائدة:
- تتأكد أن الكود يعمل قبل نشره
- تعديلات المستقبل لا تكسر شيء
- تدريب ممتاز للطلبة

---

## Slide 12: Summary

✅ استخدام MySQL مع جميع HTTP Methods\
✅ الفرق بين `JOIN` و `Subquery`\
✅ تجنب SQL Injection عبر `prepare()`\
✅ الحماية من XSS باستخدام `htmlspecialchars()`\
✅ فصل الاستعلامات في API نظيفة وآمنة باستخدام OOP\
✅ كائنات `Student`, `Course`, `Enrollment` تنفذ العمليات بدلاً من أكواد مكررة\
✅ استخدام trait لتنظيم الاتصال\
✅ فهم متى نستخدم `new mysqli()` مباشرة ومتى نستخدم abstraction\
✅ كتابة اختبارات وحدات تلقائية بـ PHPUnit

---

## 🎯 Homework:

1. أنشئ `Course.php`, `Student.php`, `Enrollment.php`

   - كل كلاس يحتوي على دوال مثل `getAll()`, `getById()`, `add()`, `update()`, `delete()`

2. عدل APIs القديمة لاستخدام الكلاسات

3. ✨ تحسين إضافي:

   - أضف token authentication داخل كلاس `Auth`

4. 💡 **ربط مع المشروع:**

   - جرب تنفيذ استعلام JOIN داخل `Enrollment::getAllWithNames()`
   - أضف حماية كاملة إلى كل دالة في الكلاسات

5. ⚙️ **تحدي متقدم:**

   - `Student::getWithCourseCount()` – تعرض عدد الكورسات لكل طالب
   - حماية كاملة من SQL Injection وXSS
   - ✨ أضف اختبار باستخدام PHPUnit للدالة

