<?php
$colors = [
  "Red", 
  "Green", 
  "Blue" , 
  "purple" , 
  "purple"
];
// echo $colors[1]; // Red

for($i = 0 ; $i < 3 ; $i++){
  // echo $colors[$i] . "<br>"; // Red
}

// echo "<br>";

foreach ($colors as $variable) {
  // echo $variable . "<br>";
}

$persons =[ 
  [ "name" => "Ahmed", "age" => 22 ],
  [ "name" => "ali", "age" => 23 ]
];
// echo $persons[0]["name"]; // Ahmed

$user = [ 
  "name" => "Ahmed", 
  "age" => 22 ,
  "city" => "sohag"
];

echo $user["name"] ."<br>"; // Ahmed


foreach ($user as $y => $x) {
  echo $y . "<br>" ;
}



for ($i=0; $i < 2 ; $i++) { 
    foreach($persons[0] as $k => $v){
    // echo $k . "=>" . $v ."<br>";
  }
}

$students = [
  ["name" => "Ahmed", "grade" => 90],
  ["name" => "Sara", "grade" => 85],
];
// echo $students[0]["name"]; // Ahmed

// foreach ($students as $st) {
//   // نفذ حاجة على $value
//   echo $st['name'] . '' . $st['grade'] . "<br>";
// }

// echo "<br><br>";

// foreach ($students as $key => $value) {
//     echo $key . "<br>" ; 
//     print_r($value) ;
//     echo "<br>";
//     // استخدم $key و $value
// }

// echo "<br><br>";

// foreach ($person as $key => $value) {
//     echo $key . '=>' . $value . "<br>";
//   // استخدم $key و $value
// }