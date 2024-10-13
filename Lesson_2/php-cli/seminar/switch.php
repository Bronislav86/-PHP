<?php
$n = 2;

switch ($n) {
  case 1: 
    echo 1;
    break;
  case 2: 
    echo 2;
    break;
  case 3: 
    echo 3;
    break;
  case 4: 
    echo 4;
    break;
  case 5: 
    echo 5;
    break;
  default:
  echo 'error';    
}

echo match ($n) {
  1 => 1,
  2 => 2,
  default => "error",
};