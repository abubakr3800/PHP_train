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

| المبدأ           | التوضيح                                                                                   |
|------------------|--------------------------------------------------------------------------------------------|
| **Encapsulation** | خصائص مثل `$courses` مخفية ومغلّفة داخل `Student` (سطر 7 في المثال بسلايد 8)             |
| **Inheritance**   | `Student` و `Teacher` يرثان من `Person` (سطر 1 في المثال بسلايد 8)                      |
| **Abstraction**   | `Person` يحتوي على دالة abstract لا يمكن تنفيذها مباشرة (سطر 4 في المثال بسلايد 8)       |
| **Polymorphism**  | نفس الدالة `introduce()` تُنفذ بسلوك مختلف لكل كائن عند المرور داخل `foreach` (سطر 20) |

| المبدأ           | التوضيح |
|------------------|---------|
| **Encapsulation** | خصائص مثل `$courses` مخفية ومغلّفة داخل `Student` |
| **Inheritance**   | `Student` و `Teacher` يرثان من `Person` |
| **Abstraction**   | `Person` يحتوي على دالة abstract لا يمكن تنفيذها مباشرة |
| **Polymorphism**  | نفس الدالة `introduce()` تُنفذ بسلوك مختلف لكل كائن |

---

(ثم استكمال اليوم بالسلايدات الأصلية بدءًا من Native vs OOP إلى API Integration...)

