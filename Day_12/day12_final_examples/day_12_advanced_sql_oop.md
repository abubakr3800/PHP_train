## 🎓 **Day 12: Advanced SQL + Security + OOP (6h)**

### 🔐 APIs + MySQL + OOP Protection

---

## Slide 1: Overview – Why Advanced SQL?

- حتى الآن أنشأنا APIs تقوم بالعمليات الأربعة (CRUD):\
  ✅ **GET** – جلب البيانات\
  ✅ **POST** – إضافة بيانات\
  ✅ **PUT** – تعديل\
  ✅ **DELETE** – حذف

- اليوم سنتعمق في:

  - **Joins**
  - **Subqueries**
  - **GROUP BY, HAVING, ORDER BY, LIMIT**
  - **CREATE VIEW**
  - **SQL Injection**
  - **XSS Prevention**
  - **API Security Best Practices**
  - **استخدام OOP في بناء APIs**
  - **أنواع إضافية من الهجمات: Exploits, MITM, Protocol Attacks**

📌 المشروع المرتبط:\
APIs تستخدم جداول `students`, `courses`, `enrollments`, `admin` باستخدام كائنات OOP (`Student`, `Course`, `Enrollment`).

---

## Slide 2: CRUD with API & SQL Mapping

| HTTP Method | SQL Equivalent | مثال تطبيقي     |
| ----------- | -------------- | --------------- |
| GET         | SELECT         | get.php?id=3    |
| POST        | INSERT         | post.php        |
| PUT         | UPDATE         | put.php?id=2    |
| DELETE      | DELETE         | delete.php?id=7 |

🔧 مثال عملي (OOP):

```php
require_once "Course.php";
$course = new Course($conn);
$data = $course->getById($_GET['id']);
echo json_encode($data);
```

---

## Slide 2.5: إعداد الاتصال بـ MySQL (OOP)

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
      $this->host, $this->username,
      $this->password, $this->dbname,
      $this->port
    );
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
}
```

---

## Slide 2.6: استخدام Trait للاتصال

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
      $this->host, $this->username,
      $this->password, $this->dbname,
      $this->port
    );
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
}
```

ثم:

```php
class Database {
  use MySQLConnection;
}
```

---

## Slide 2.7: مقارنة بين `new mysqli()` و `Database class`

| مقارنة                 | `new mysqli()` | `Database class` |
| ---------------------- | -------------- | ---------------- |
| سهولة الاستخدام        | ✅              | ❌                |
| إعادة الاستخدام        | ❌              | ✅                |
| تنظيم الكود            | ❌              | ✅                |
| مناسب للمشاريع الكبيرة | ❌              | ✅                |

---

## Slide 3: SQL JOIN – Why?

```sql
SELECT s.name, c.title
FROM students s
JOIN enrollments e ON s.id = e.student_id
JOIN courses c ON c.id = e.course_id;
```

🧹 Task:

```sql
SELECT c.title, COUNT(e.student_id) AS total
FROM courses c
LEFT JOIN enrollments e ON c.id = e.course_id
GROUP BY c.id;
```

---

## Slide 3.5: CREATE VIEW – طريقة إنشاء View في SQL

`VIEW` عبارة عن استعلام محفوظ يمكنك التعامل معه كأنه جدول:

```sql
CREATE VIEW student_courses AS
SELECT s.name AS student_name, c.title AS course_title
FROM students s
JOIN enrollments e ON s.id = e.student_id
JOIN courses c ON c.id = e.course_id;
```

🧪 للاستخدام:

```sql
SELECT * FROM student_courses WHERE course_title = 'Web Development';
```

### 📌 الفرق بين View و Table:

- View لا تخزن بيانات فعلية بل تحفظ الاستعلام فقط
- تُستخدم لتبسيط استعلامات معقدة وإعادة استخدامها
- يمكن استخدامها للقراءة فقط (حسب نوعها)

### 💡 فائدة:

- تقليل التكرار
- تبسيط منطق العرض للمستخدمين أو الـ APIs

---

## Slide 4: Subqueries – المفهوم والتطبيق

**Subquery = استعلام داخل استعلام**

### مثال 1: طلاب سجلوا في أكثر من كورس

```sql
SELECT name FROM students
WHERE id IN (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  HAVING COUNT(*) > 1
);
```

### مثال 2: طالب سجل في أكبر عدد كورسات

```sql
SELECT name FROM students
WHERE id = (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  ORDER BY COUNT(*) DESC
  LIMIT 1
);
```

### مثال 3: الطلاب الذين لم يسجلوا في أي كورس

```sql
SELECT name FROM students
WHERE id NOT IN (SELECT student_id FROM enrollments);
```

---

## Slide 5: شرح GROUP BY مع أمثلة إضافية

`GROUP BY` تُستخدم لتجميع النتائج حسب عمود معين.

### مثال 1: عدد الكورسات لكل طالب
```sql
SELECT student_id, COUNT(*) as total
FROM enrollments
GROUP BY student_id;
```

### مثال 2: كم طالب مسجل في كل كورس
```sql
SELECT course_id, COUNT(*) as total
FROM enrollments
GROUP BY course_id;
```

### ملاحظة:
- `GROUP BY` يجب أن تُستخدم مع دوال تجميع مثل `COUNT`, `SUM`, `AVG`, `MAX`, `MIN`

---

## Slide 6: HAVING – مقارنة WHERE و HAVING

|       | WHERE           | HAVING                |
|-------|-----------------|------------------------|
| يُستخدم قبل `GROUP BY` | ✅                     | ❌                      |
| يُستخدم بعد `GROUP BY` | ❌                     | ✅                      |
| يتعامل مع البيانات قبل التجميع | ✅               | ❌                      |
| يتعامل مع نتائج التجميع       | ❌               | ✅                      |

### مثال:
```sql
SELECT student_id, COUNT(*) as total
FROM enrollments
GROUP BY student_id
HAVING COUNT(*) > 1;
```

---

## Slide 7: ORDER BY و LIMIT

### ORDER BY:
ترتيب النتائج حسب عمود معين تصاعدياً (ASC) أو تنازلياً (DESC)

```sql
SELECT * FROM students
ORDER BY name ASC;
```

### LIMIT:
تحديد عدد النتائج المعروضة

```sql
SELECT * FROM students
LIMIT 5;
```

### معاً:
```sql
SELECT name FROM students
ORDER BY id DESC
LIMIT 1;
```

---

## Slide 8: SQL Injection

❌ خطأ:

```php
$sql = "SELECT * FROM users WHERE email = '$email'";
```

✅ باستخدام `prepare()`:

```php
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
```

---

## Slide 9: XSS – Cross Site Scripting

❌ غير آمن:

```php
echo $_GET['name'];
```

✅ آمن:

```php
echo htmlspecialchars($_GET['name']);
```

---

## Slide 10: Secure API Example

```php
$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$data = $stmt->get_result()->fetch_assoc();
echo json_encode(array_map("htmlspecialchars", $data));
```

---

## Slide 11: Compare – Secure vs Insecure

| Feature            | Secure               | Insecure         |
| ------------------ | -------------------- | ---------------- |
| Input Validation   | ✅ `is_numeric()`     | ❌ مباشر          |
| Prepared Statement | ✅ `bind_param`       | ❌ متغير داخل SQL |
| Output Sanitize    | ✅ `htmlspecialchars` | ❌ Raw echo       |
| Abstraction (OOP)  | ✅ Class/Method       | ❌ كود مباشر      |

---

## Slide 12: OOP Task

🎏 `Enrollment::getStudentCourseCount()`:

```sql
SELECT s.name, COUNT(e.course_id) AS total
FROM students s
JOIN enrollments e ON s.id = e.student_id
GROUP BY s.id;
```

---

## Slide 13: Global Clean Function

```php
function clean($val) {
  return htmlspecialchars(trim($val));
}
```

---

## Slide 14: Unit Testing

✅ مكتبة: PHPUnit\
📦 التركيب: Composer\
🪪 ملف اختبار:

```php
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
  public function testGetById() {
    $student = new Student($conn);
    $this->assertEquals("Ahmed", $student->getById(1)['name']);
  }
}
```

---

## Slide 15: أنواع إضافية من الهجمات

### Exploits

- Buffer Overflow
- RCE
- Privilege Escalation

### MITM

- اعتراض البيانات في Wi-Fi
- حل: HTTPS + 2FA + HSTS

### Protocol Exploits

- DNS Spoofing
- TCP Reset
- Header Injection

---

## Slide 16: أمثلة وحلول عملية

🤔 Exploit:

```php
eval($_GET['cmd']); // ❌
```

✅ الحل:

```php
// لا تستخدم eval أو shell_exec
```

🛡️ MITM:

- سجل دخول على Wi-Fi = كلمة المرور مكشوفة\
  ✅ استخدم HTTPS دائماً.

🛁 DNS Spoofing:

- fake `facebook.com`\
  ✅ استخدم DNSSEC + تحقق من 🔒

🛁 HTTP Header Injection:

```php
$_GET['name'] = "\r\nSet-Cookie: admin=true";
```

✅ استخدم `htmlspecialchars()` و `str_replace()`.

---

## Slide 17: Summary

✅ استخدام MySQL + OOP + Security\
✅ حماية XSS, SQL Injection\
✅ استخدام Traits\
✅ فحص Unit Testing\
✅ نماذج للهجمات الواقعية Exploits, MITM, DNS\
✅ واجهات API منظمة باستخدام OOP\
✅ فهم شامل لـ GROUP BY, HAVING, ORDER BY, LIMIT, Subquery

---

## Homework:

1. كائنات `Student`, `Course`, `Enrollment` بدوال CRUD
2. APIs منظمة بالكامل
3. `Auth` مع token
4. حماية شاملة
5. وحدة اختبار باستخدام PHPUnit

