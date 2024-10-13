<?php
//declare(strict_types=1);
$x = 1;

function inc(&$x) {
  $x++;
}

inc($x);
echo $x;
die();
// foo();

// function foo(){
//   $x = 2;
//   echo $x;
// }

function add(int $x, int $y):int {
  return $x + $y;
}

$add = fn($x, $y) => $x + $y;

$result = add(1, 2);
echo $result;