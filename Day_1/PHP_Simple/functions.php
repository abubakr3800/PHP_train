<?php

// Function definition examples
function simpleFunction() {
    return "Hello from a simple function!";
}

function calculateArea($length, $width) {
    return $length * $width;
}

function formatName($firstName, $lastName) {
    return ucfirst($firstName) . " " . ucfirst($lastName);
}

function isEven($number) {
    return $number % 2 == 0;
}

$func = function($x) { 
            return $x * 2; 
};

echo simpleFunction() . "<br>";
echo calculateArea(5, 3) . "<br>";
echo formatName("john", "doe") . "<br>";
echo (isEven(10) ? "Yes" : "No") . "<br>";
echo $func(5) . "<br>";