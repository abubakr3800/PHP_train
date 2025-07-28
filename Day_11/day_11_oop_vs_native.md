# Day 11: Advanced PHP – OOP Basics & API Integration (6h)

---

## Slide 1: What is OOP?

- **OOP = Object-Oriented Programming**
- أسلوب برمجي يعتمد على الكائنات (Objects)
- كل كائن يمثل كيان حقيقي مثل: طالب، سيارة، منتج...

### ✅ الفوائد:

- **Modularity:** فصل كل جزء في كلاس مستقل
- **Reusability:** إعادة استخدام الكود بسهولة
- **Maintainability:** سهولة التعديل والتوسعة
- **Scalability:** مرونة في تطوير التطبيق مستقبلاً

### ✅ يتكون OOP من:

- كائنات (Objects)
- خصائص (Properties)
- دوال (Methods)

```php
class Student {
  public $name;
  public function attend() {
    echo "$this->name is attending...";
  }
}
```

**🩽 Task:**
أنشئ كلاس `Book` يحتوي على خاصية `title` ودالة `read()` تطبع العنوان

---

## Slide 2: مبادئ OOP الأربعة

> البرمجة كائنية التوجه أو **OOP** ليست مجرد استخدام كائنات (Objects)، بل تقوم على **أربعة مبادئ أساسية** يجب على كل مبرمج فهمها وإتقانها لبناء أنظمة قوية ومرنة:

### المبادئ الأربعة:

| المبدأ             | المعنى                                                                 |
|--------------------|------------------------------------------------------------------------|
| **Encapsulation**  | تغليف البيانات والدوال داخل كائن وإخفاء التفاصيل الداخلية              |
| **Inheritance**    | الوراثة - إمكانية أن يرث كلاس جديد خصائص ودوال من كلاس آخر              |
| **Abstraction**    | التجريد - إخفاء التعقيد وتوفير واجهات بسيطة للتعامل مع الكائنات        |
| **Polymorphism**   | تعدد الأشكال - استخدام نفس الدالة بطرق مختلفة بحسب السياق أو الكلاس      |

---

## Slide 3: Encapsulation - التغليف

**Encapsulation** يعني تجميع الخصائص والدوال داخل كائن، والتحكم في الوصول إليها باستخدام `public`, `private`, و `protected`. الهدف هو حماية البيانات ومنع التلاعب بها من الخارج.

### مقارنة بين Public, Private, Protected:

| Access Modifier | داخل الكلاس | الوراثة (Subclass) | خارج الكلاس |
|-----------------|--------------|---------------------|---------------|
| `public`        | ✅           | ✅                  | ✅            |
| `protected`     | ✅           | ✅                  | ❌            |
| `private`       | ✅           | ❌                  | ❌            |

### مثال توضيحي:
```php
class Example {
  public $a = "Public";
  protected $b = "Protected";
  private $c = "Private";

  public function showAll() {
    echo $this->a;
    echo $this->b;
    echo $this->c;
  }
}

$obj = new Example();
echo $obj->a;      // يعمل
// echo $obj->b;   // خطأ - محمي
// echo $obj->c;   // خطأ - خاص
$obj->showAll();   // يعرض الثلاثة من داخل الكلاس
```

### الفائدة:
- لا يمكن الوصول مباشرة إلى الخصائص الحساسة مثل `$balance`
- يتم التحكم في التعديل من خلال دوال محددة فقط

**Encapsulation** يعني تجميع الخصائص والدوال داخل كائن، والتحكم في الوصول إليها باستخدام `public`, `private`, و `protected`. الهدف هو حماية البيانات ومنع التلاعب بها من الخارج.

### مثال:
```php
class BankAccount {
  private $balance = 0;

  public function deposit($amount) {
    $this->balance += $amount;
  }

  public function getBalance() {
    return $this->balance;
  }
}

$account = new BankAccount();
$account->deposit(1000);
echo $account->getBalance();
```

### الفائدة:
- لا يمكن الوصول مباشرة إلى `$balance`
- يتم التحكم في التعديل من خلال دوال محددة فقط

---

## Slide 4: Inheritance - الوراثة

**Inheritance** تعني أن كلاس يمكن أن يرث من كلاس آخر، ويستفيد من الخصائص والدوال الموجودة فيه، مع إمكانية التوسيع والتعديل.

### مثال:
```php
class User {
  public $name;
  public function login() {
    echo "$this->name logged in";
  }
}

class Student extends User {
  public $grade;
  public function study() {
    echo "$this->name is studying...";
  }
}

$s = new Student();
$s->name = "Ali";
$s->login();
$s->study();
```

### الفائدة:
- إعادة استخدام الكود
- تنظيم العلاقات بين الكائنات

---

## Slide 5: Abstraction - التجريد (الجزء 1)

**Abstraction** تعني إخفاء التفاصيل الداخلية للكائن والتركيز على ما يقوم به. يتم ذلك باستخدام `abstract class` أو `interface` لتحديد دوال يجب أن تُنفذ لاحقًا.

### مثال:
```php
abstract class Person {
  protected $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function introduce();
}

class Teacher extends Person {
  public function introduce() {
    echo "I am $this->name, and I teach.";
  }
}
```

---

## Slide 6: Abstraction - التجريد (الجزء 2)

### شرح إضافي:
Abstraction يعني إنك تكتب كلاس عام (مجرد) يحدد السلوك المشترك، وتترك التفاصيل للكلاسات المشتقة. يساعد في إنشاء هيكل موحد دون فرض طريقة التنفيذ.

### سيناريو عملي:
نفترض أنك تطور نظامًا فيه أنواع مختلفة من المستخدمين: طالب، مدرس، مدير. كل منهم يعرف نفسه بطريقة مختلفة. يمكننا استخدام abstraction لتوحيد الواجهة.

### مثال:
```php
abstract class User {
  protected $name;

  public function __construct($name) {
    $this->name = $name;
  }

  abstract public function describe();
}

class Student extends User {
  public function describe() {
    echo "Student: $this->name\n";
  }
}

class Admin extends User {
  public function describe() {
    echo "Admin: $this->name\n";
  }
}

$users = [
  new Student("Ali"),
  new Admin("Salma")
];

foreach ($users as $user) {
  $user->describe();
}
```

---

## Slide 6.5: Abstraction - ماذا يحدث عند الخطأ؟

### ❌ استخدام `abstract` داخل كلاس غير مجرد:

```php
class Person {
  abstract public function introduce(); // ❌ خطأ
}
```

🔴 **النتيجة:**

> Fatal error: Abstract function Person::introduce() cannot be declared in non-abstract class

✅ **الحل:**

```php
abstract class Person {
  abstract public function introduce();
}
```

---

### ❌ إنشاء كائن من كلاس abstract:

```php
abstract class Animal {
  abstract public function makeSound();
}

$dog = new Animal(); // ❌ خطأ
```

🔴 **النتيجة:**

> Fatal error: Cannot instantiate abstract class Animal

✅ **الحل:**

```php
class Dog extends Animal {
  public function makeSound() {
    echo "Woof!";
  }
}
$dog = new Dog();
```

---

### ❌ كلاس يرث من abstract لكنه لم يطبّق الدوال المجردة:

```php
abstract class Person {
  abstract public function introduce();
}

class Student extends Person {
  // ❌ لم ينفذ الدالة
}
```

🔴 **النتيجة:**

> Fatal error: Class Student contains 1 abstract method and must therefore be declared abstract or implement the remaining methods

✅ **الحل:**

```php
class Student extends Person {
  public function introduce() {
    echo "I'm a student.";
  }
}
```

---

### شرح إضافي:

Abstraction يعني إنك تكتب كلاس عام (مجرد) يحدد السلوك المشترك، وتترك التفاصيل للكلاسات المشتقة. يساعد في إنشاء هيكل موحد دون فرض طريقة التنفيذ.

### سيناريو عملي:

نفترض أنك تطور نظامًا فيه أنواع مختلفة من المستخدمين: طالب، مدرس، مدير. كل منهم يعرف نفسه بطريقة مختلفة. يمكننا استخدام abstraction لتوحيد الواجهة.

### مثال:

```php
abstract class User {
  protected $name;

  public function __construct($name) {
    $this->name = $name;
  }

  abstract public function describe();
}

class Student extends User {
  public function describe() {
    echo "Student: $this->name\n";
  }
}

class Admin extends User {
  public function describe() {
    echo "Admin: $this->name\n";
  }
}

$users = [
  new Student("Ali"),
  new Admin("Salma")
];

foreach ($users as $user) {
  $user->describe();
}
```

---

## Slide 7: Polymorphism - تعدد الأشكال

**Polymorphism** يسمح باستخدام نفس الدالة مع كائنات مختلفة، بحيث يكون لكل كائن سلوك مختلف رغم استخدام نفس الواجهة.

### مثال:
```php
class Student extends Person {
  public function introduce() {
    echo "I am $this->name, a student.";
  }
}

class Teacher extends Person {
  public function introduce() {
    echo "I am $this->name, a teacher.";
  }
}

$people = [
  new Student("Ali"),
  new Teacher("Sara")
];

foreach ($people as $person) {
  $person->introduce();
}
```

---

## Slide 8: مثال تطبيقي شامل

```php
abstract class Person {
  protected $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function introduce();
}

class Student extends Person {
  private $courses = [];

  public function enroll($course) {
    $this->courses[] = $course;
  }

  public function introduce() {
    echo "I'm $this->name and I'm a student.";
  }
}

class Teacher extends Person {
  public function introduce() {
    echo "I'm $this->name and I teach programming.";
  }
}

$people = [
  new Student("Ali"),
  new Teacher("Sara")
];

foreach ($people as $person) {
  $person->introduce();
}
```

---

## Slide 9: توضيح المبادئ في المثال السابق

| المبدأ           | التوضيح |
|------------------|---------|
| **Encapsulation** | خصائص مثل `$courses` مخفية ومغلّفة داخل `Student` |
| **Inheritance**   | `Student` و `Teacher` يرثان من `Person` |
| **Abstraction**   | `Person` يحتوي على دالة abstract لا يمكن تنفيذها مباشرة |
| **Polymorphism**  | نفس الدالة `introduce()` تُنفذ بسلوك مختلف لكل كائن |

---

## Slide 10: Native vs OOP

### Native PHP:

```php
$name = "Ali";
echo "$name is attending...";
```

### OOP:

```php
$student1 = new Student();
$student1->name = "Ali";
$student1->attend();
```

**✔️ الفائدة:**

- كود أكثر نظمًا
- سهل إعادة استخدامه

---

## Slide 11: Properties & Methods

```php
class Student {
  public $name;
  public $email;

  public function sayHello() {
    echo "Hello $this->name";
  }

  public function showEmail() {
    echo $this->email;
  }
}
```

**🩽 Task:**\
اضف `email` واستعملها بدالة `showEmail()`

---

### Encapsulation vs Data Hiding

| المفهوم             | التوضيح                                                                 |
|---------------------|-------------------------------------------------------------------------|
| **Encapsulation**   | تجميع البيانات والدوال معًا داخل كائن وتوفير واجهة موحدة للتفاعل معها.  |
| **Data Hiding**     | إخفاء البيانات الحساسة باستخدام `private` أو `protected` لمنع الوصول المباشر. |

### مثال:
```php
class Account {
  private $balance = 0; // Data Hiding

  public function deposit($amount) { // Encapsulation
    if ($amount > 0) {
      $this->balance += $amount;
    }
  }

  public function getBalance() {
    return $this->balance;
  }
}
```

**🩽 Task:** أنشئ كلاس `Wallet` يحتوي على خاصية `amount` مخفية، ودوال `addMoney()` و `checkAmount()` للتعامل معها.

---

## Slide 10: Constructor - المُنشئ

**Constructor** هو دالة خاصة داخل الكلاس يتم تنفيذها تلقائيًا عند إنشاء الكائن (object). تُستخدم لتهيئة الخصائص بقيم ابتدائية.

### الشكل العام:
```php
class ClassName {
  public function __construct() {
    // يتم التنفيذ عند إنشاء object
  }
}
```

### مثال عملي:
```php
class Student {
  public $name;
  public $email;

  function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  public function showInfo() {
    echo "Student: $this->name - $this->email";
  }
}

$std = new Student("Ali", "ali@example.com");
$std->showInfo();
```

**🩽 Task:**
أنشئ كلاس `Course` يحتوي على `title`, `instructor`, ودالة `__construct` تضبط القيم و`describe()` تطبع معلومات الكورس.

---

## Slide 11: Access Modifiers - محددات الوصول

| Access Modifier | داخل الكلاس | الوراثة | خارج الكلاس |
|-----------------|--------------|----------|---------------|
| `public`        | ✅           | ✅       | ✅            |
| `protected`     | ✅           | ✅       | ❌            |
| `private`       | ✅           | ❌       | ❌            |

### مثال:
```php
class User {
  public $username = "admin";
  protected $role = "moderator";
  private $password = "secret";

  public function showInfo() {
    echo $this->username;  // ✅
    echo $this->role;      // ✅
    echo $this->password;  // ✅
  }
}

$user = new User();
echo $user->username; // ✅
// echo $user->role; // ❌
// echo $user->password; // ❌
```

**🩽 Task:**
أنشئ كلاس `Employee` يحتوي على `name` (public)، `salary` (protected)، `bonus` (private). أضف دالة تطبع كل القيم من داخل الكلاس.

---

## Slide 11.5: Inheritance - الوراثة

**Inheritance** تعني أن كلاس يمكن أن يرث من كلاس آخر، ويستفيد من الخصائص والدوال الموجودة فيه، مع إمكانية التوسيع والتعديل.

### لماذا نستخدم الوراثة؟
- لتقليل التكرار في الكود (DRY)
- لتنظيم العلاقات بين الكائنات
- لتوسيع وظائف الكائنات بسهولة

### أنواع الوراثة في PHP:
- **Single Inheritance** (كلاس يرث من كلاس واحد فقط)
- PHP لا تدعم الوراثة المتعددة (لكن يمكن تعويضها بالـ Traits)

### مثال:
```php
class User {
  public $name;
  public function login() {
    echo "$this->name logged in";
  }
}

class Student extends User {
  public $grade;
  public function study() {
    echo "$this->name is studying...";
  }
}

$s = new Student();
$s->name = "Ali";
$s->login();
$s->study();
```

### ⚠️ ملاحظات:
- الكلاس `Student` يحصل تلقائيًا على دوال وخصائص `User`
- يمكنه إضافة دوال خاصة أو تعديل دوال الأب (Overriding)

**🩽 Task:**
أنشئ كلاس `Animal` يحتوي على `name` و`makeSound()`، ثم أنشئ كلاس `Dog` يرث منه ويُعيد تنفيذ `makeSound()` لتطبع "Woof".

---

## Slide 12: Traits - الخصائص المشتركة

**Traits** في PHP تسمح بمشاركة وظائف بين عدة كائنات دون استخدام الوراثة الكاملة. مفيدة عندما تريد إضافة دوال مشتركة لأكثر من كلاس بدون تكرار الكود.

### مثال:
```php
trait Logger {
  public function log($message) {
    echo "[LOG] $message";
  }
}

class Student {
  use Logger;
  public $name = "Ali";
}

class Teacher {
  use Logger;
  public $name = "Sara";
}

$s = new Student();
$s->log("Student object created");
```

**🩽 Task:**
أنشئ Trait باسم `Timestampable` يحتوي على دالة `currentTimestamp()` تطبع التاريخ والوقت. استخدمه داخل كلاس `Order` و`Invoice`.

---

## Slide 17: مقارنة شاملة
---

## Slide 14: مهام عملية على مبادئ OOP الأربعة

**Inheritance**

- 🔧 Task: أنشئ كلاس `Vehicle` يحتوي على `make`, `model`, ودالة `info()`. ثم أنشئ كلاس `Car` يرث منه ويضيف خاصية `fuelType` ويعيد تنفيذ `info()`.

**Encapsulation**

- 🔧 Task: أنشئ كلاس `BankAccount` يحتوي على خاصية `balance` خاصة، ودوال `deposit()`, `withdraw()` و `getBalance()`.

**Abstraction**

- 🔧 Task: أنشئ كلاس `Employee` مجرد (abstract) يحتوي على دالة `calculateSalary()`. ثم أنشئ كلاس `HourlyEmployee` ينفذ هذه الدالة ويحسب الراتب بناء على عدد ساعات.

**Polymorphism**

- 🔧 Task: أنشئ كلاس `Shape` يحتوي على دالة `draw()`، وأنشئ كلاسين `Circle`, `Rectangle` يرثان منه ويعيدان تنفيذ `draw()` بطريقة مختلفة. ثم نفذ حلقة تطبع كل شكل.

---


### Native:

```php
$name = "Ali";
$email = "ali@mail.com";
echo "$name - $email";
```

### OOP:

```php
$student = new Student("Ali", "ali@mail.com");
echo $student->name;
```

---

## Slide 18: ربط OOP مع API

### Native:

```php
// post.php
$name = $_POST['name'];
echo json_encode(["name" => $name]);
```

### OOP:

```php
class Student {
  public $name;
  function __construct($name) {
    $this->name = $name;
  }
  function toJson() {
    return json_encode(["name" => $this->name]);
  }
}

$s = new Student($_POST['name']);
echo $s->toJson();
```

## Slide 13: ربط OOP مع API - تطبيق عملي

البرمجة كائنية التوجه (OOP) تسهل علينا التعامل مع API بشكل منظم ومرن، حيث يمكننا تحويل الكائنات إلى JSON بسهولة، والتحكم في طريقة تخزين واسترجاع البيانات.

### مثال:

```php
// file: Student.php
class Student {
  public $name;
  public $email;
  private $isActive = false;

  public function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  public function activate() {
    $this->isActive = true;
  }

  public function getStatus() {
    return $this->isActive ? "Active" : "Inactive";
  }

  public function toJson() {
    return json_encode([
      "name" => $this->name,
      "email" => $this->email,
      "status" => $this->getStatus()
    ]);
  }
}

// file: api.php
include 'Student.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"), true);
  $student = new Student($data['name'], $data['email']);
  $student->activate();
  echo $student->toJson();
}
```

### ✅ فوائد هذا الأسلوب:

- فصل منطق المعالجة عن العرض
- تسهيل اختبار الوحدات (Unit Testing)
- حماية البيانات الحساسة داخل الكلاس

**🩽 Task:** قم بإنشاء API بسيط يعالج بيانات `Course` (title, duration, isPublished). استخدم كلاس، دوال get/set، وtoJson().

---

## Slide 19: Task

- أنشئ كلاس `Student`
  - `name`, `email`, `age`, `private isActive`
- أضف دالة `activate()` و `getStatus()`
- جرب استخدامه مع API `POST`

---

## الخلاصة:

- ✅ OOP vs Native
- ✅ Properties, Methods, Access Control
- ✅ Inheritance, Traits
- ✅ Constructor, Encapsulation
- ✅ ربط بـ API

---

