<?php
  $skills = ["HTML", "CSS", "JavaScript", "PHP"];

  echo "You have " . count($skills) . " skills.<br>";

  if (in_array("PHP", $skills)) {
    echo "You know PHP!<br><br><br>";
  }

  echo "Skill Names: ";
  print_r(array_keys($skills));
  echo "<br>";

  echo "Skill Values: ";
  print_r(array_values($skills));
  echo "<br><br><br>";

  $users = [
    "John" => "Developer",
    "Jane" => "Designer",
    "Bob" => "Developer"
  ];

  echo "User Names: ";
  print_r(array_keys($users));
  echo "<br>";

  echo "User jobs: ";
  print_r(array_values($users));
  echo "<br><br><br>";

  $username = array_keys($users);
  $userjobs = array_values($users);
  echo $username[0] . " is a " . $userjobs[0] . "<br><br><br>";

?>
