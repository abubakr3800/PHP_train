<?php
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

class SubExample extends Example {
    public function showsub() {
        echo "this->a = $this->a , this->b = $this->b , this->c = $this->c";
    }
}

$obj = new Example();
$obj2 = new SubExample();
echo $obj->a;      // يعمل
// echo $obj->b;   // خطأ - محمي
// echo $obj->c;   // خطأ - خاص
$obj->showAll();   // يعرض الثلاثة من داخل الكلاس
echo "<br><hr><br>";
// $obj2->showsub();   // يعرض اثنين من داخل الكلاس وايرور
