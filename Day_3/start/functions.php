<?php
function sayHello($name) { 
    // $y = $x + 1 ;
    echo "Hello $name <br>" ; 
    return "you passed true parameter $name";
}

echo sayHello("ahmed");
// sayHello("ali");

function calcArea($x , $y){
    return $x * $y;
}

$z = 8 ;

echo "size is :" . ($z * calcArea(9 , 8) ) ;

$name = 'ahmed';
echo " the length of my name ( $name ) is : " . strlen($name);