<?php
// Different data types
$stringVar = "Hello World";
$integerVar = 42;
$floatVar = 3.14;
$booleanVar = true;
$arrayVar = array(1, 2, 3);
$nullVar = null;

// Using gettype() function
// echo "the variable is: " . $stringVar . " and the type is: " . gettype($stringVar) . "<br>";
// echo "the variable is: " . $integerVar . " and the type is: " . gettype($integerVar) . "<br>";
// echo "the variable is: " . $floatVar . " and the type is: " . gettype($floatVar) . "<br>";
// echo "the variable is: " . $booleanVar . " and the type is: " . gettype($booleanVar) . "<br>";
// echo "the variable is: [ " . implode(",", $arrayVar) . " ] and the type is: " . gettype($arrayVar) . "<br>";
// echo "print the array with print_r: ==> " . print_r ($arrayVar, true) . " and the type is: " . gettype($arrayVar) . "<br>";
// echo "the variable is: " . $nullVar . " and the type is: " . gettype($nullVar) . "<br>";

// echo strlen("ahmed");

$func = function($x) { return $x * 2; };
// echo $func(5);

/*
// A string is a sequence of chars
	$stringTest = "this is a sequence of chars"; 
	echo $stringTest[0] . "<br>"; //output: t
	echo $stringTest . "<br>"; //output: this is a sequence of chars
// A single quoted strings is displayed “as-is”
	$age = 37 . "<br>";
	$stringTest = 'I am $age years old'; // output: I am $age years old
	$stringTest = "I am $age years old"; // output: I am 37 years old
// Concatenation
	$conc = "s " . "a " . "composed " . "string";
	echo $conc . "<br>"; // output: is a composed string
	$newConc = 'Also $conc '.$conc;
	echo $newConc . "<br><br><br><br><br>"; // output: Also $conc is a composed string
*/

// Explode function
	$sequence = "A,B,C,D,E,F,G";
	$elements = explode ("," , $sequence);
	// Now elements is an array with all substrings between "," char
	echo $elements[0] . "<br>"; // output: A;
	echo $elements[1] . "<br>"; // output: B;
	echo $elements[2] . "<br>"; // output: C;
	echo $elements[3] . "<br>"; // output: D;
	echo $elements[4] . "<br>"; // output: E;
	echo $elements[5] . "<br>"; // output: F;
	echo $elements[6]; // output: G;