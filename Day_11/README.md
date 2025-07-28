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
class Car {
  public $brand;
  public function drive() {
    echo "Driving...";
  }
}
```

**🧹 Task:**\
أنشئ كلاس `Book` يحتوي على خاصية `title` ودالة `read()` تطبع العنوان

---

## Slide 2: Objects

- الكائن (object) هو نسخة من الكلاس.

```php
$car1 = new Car();
$car1->brand = "Toyota";
$car1->drive();
```

**🧹 Task:**\
أنشئ كائن من كلاس `Book` واطبع عنوانه

---

## Slide 3: Properties & Methods

```php
class Student {
  public $name;
  public function sayHello() {
    echo "Hello $this->name";
  }
}
```

**🧹 Task:**\
أضف `email` واستعملها بدالة `showEmail()`

---

## Slide 3.1: Access Modifiers (Modifiers الوصول)

| Modifier    | داخل الكلاس | خارج الكلاس | الوراثة |
| ----------- | ----------- | ----------- | ------- |
| `public`    | ✅           | ✅           | ✅       |
| `private`   | ✅           | ❌           | ❌       |
| `protected` | ✅           | ❌           | ✅       |

```php
class User {
  public $name = "Ali";
  private $password = "12345";
  protected $secret = "hidden";

  public function getPassword() {
    return $this->password;
  }
}
```

**شرح مبسط:**

- `public`: الكل يقدر يشوفه ويستخدمه.
- `private`: لا يُرى إلا من داخل نفس الكلاس فقط.
- `protected`: لا يُرى إلا من داخل الكلاس أو الكلاسات الوراثية.

---

## Slide 3.2: Encapsulation vs Data Hiding

| Concept       | Description                               |
| ------------- | ----------------------------------------- |
| Encapsulation | تجميع الخصائص والدوال داخل كائن           |
| Data Hiding   | إخفاء البيانات الحساسة باستخدام `private` |

> ✳️ **Encapsulation** هو مبدأ تصميمي في OOP يربط البيانات بالدوال التي تتعامل معها داخل نفس الكلاس مما يجعل الكود منظم وآمن وأسهل في الصيانة.

> 🔐 **Data Hiding** هو جزء من Encapsulation، ويتم باستخدام access modifiers مثل `private` و `protected` لمنع الوصول المباشر للبيانات الحساسة من خارج الكلاس.

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
```

**🧠 Note:** لا يمكن التعديل مباشرة على `$balance` لأنه `private`

---

## Slide 4: Constructors

> الConstructor هو دالة خاصة تُنفذ تلقائياً عند إنشاء كائن جديد من الكلاس. وظيفتها الأساسية هي تهيئة الخصائص initial values بدون الحاجة لنداء دوال إضافية.

```php
class Product {
  public $title;
  public $price;

  // Constructor يتم استدعاؤه تلقائيًا عند إنشاء الكائن
  function __construct($title, $price) {
    // يتم تعيين القيم الابتدائية للكائن
    $this->title = $title;
    $this->price = $price;
  }
}
```

**🧹 Task:**\
أنشئ `Course` وسلم `title` + `hours` من ال constructor

---

## Slide 5: Inheritance

> الوراثة (Inheritance) تسمح لكلاس جديد أن يرث الخصائص والدوال من كلاس آخر. هذا يُستخدم لتوسيع السلوك بدون تكرار الكود. على سبيل المثال، يمكن لـ `Admin` أن يستخدم دوال `User` بالإضافة لدواله الخاصة.

```php
class User {
  public $name;
  public function login() {
    echo "Logged in";
  }
}

// Admin يرث من User جميع الخصائص والدوال، ويمكنه إضافة دوال جديدة
class Admin extends User {
  public function deleteUser() {
    echo "Deleted";
  }
}
```

---

## Slide 6: Traits

```php
trait Logger {
  public function log($msg) {
    echo "[LOG] $msg";
  }
}

class File {
  use Logger; // تعني أننا نُعيد استخدام دالة log() الموجودة في trait Logger داخل هذا الكلاس
}
```

---

## Slide 7: Abstract Classes

> الكلاسات المجردة (Abstract Classes) لا يمكن إنشاء كائنات منها مباشرة، بل تُستخدم كقوالب (Templates) للكلاسات الأخرى التي ترث منها وتقوم بتطبيق الدوال المجردة داخلها.

```php
abstract class Shape {
  // دالة بدون جسم، يجب على الكلاس الابن أن يُعرفها
  abstract public function area();
}

class Square extends Shape {
  public $side = 2;
  public function area() {
    return $this->side ** 2;
  }
}
```

---

## Slide 8: Interfaces

> الواجهة (interface) تُستخدم لفرض وجود دوال معينة في أي كلاس يقوم بتطبيقها. فهي تحدد فقط توقيع الدوال (method signatures) ولا تحتوي على أي منطق داخلي، وتُستخدم لتوحيد طريقة تعامل الكلاسات المختلفة مع نفس الوظائف.

```php
interface Auth {
  public function login($user);
  public function logout();
}

class App implements Auth {
  public function login($user) {}
  public function logout() {}
}
```

---

## Slide 9: Why OOP in Real Projects?

- ✅ **Modularity**: فصل الأجزاء يجعل الصيانة أسهل
- ✅ **Reusability**: استخدام الكلاسات أكثر من مرة
- ✅ **Testability**: يمكن اختبار كل كلاس على حدة
- ✅ **Security**: إخفاء البيانات والتحكم في الوصول
- ✅ **Real Modeling**: نمذجة الكيانات الحقيقية بسهولة

🧠 OOP مهم جداً في REST APIs حيث يتم فصل منطق كل كيان في كلاس مستقل مثل:

- `StudentManager`
- `CourseController`
- `AuthHandler`

---

## Slide 10: Homework / Task

🧹 Task:

- أنشئ كلاس `Student` يحتوي على الخصائص التالية:

  - الاسم (name)
  - العمر (age)
  - البريد (email)
  - متغير `private` لحالة الحساب (isActive)

- أضف:

  - دالة `activate()` لتفعيل الحساب
  - دالة `getStatus()` لعرض الحالة

---

## نهاية اليوم ✅

**الخلاصة:**

- ✅ ما هو OOP ولماذا هو مهم؟
- ✅ `public`, `private`, `protected`
- ✅ `Encapsulation` و `Data Hiding`
- ✅ أدوات OOP: Traits / Abstract / Interface
- ✅ بناء كود احترافي وقابل للتوسعة

