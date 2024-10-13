<?php

$str = 'Привет';
echo $str[0] . PHP_EOL;
echo mb_strlen($str) . PHP_EOL;
echo mb_substr($str, 1, 1) . PHP_EOL;

print_r(mb_str_split($str));


// $text = "())(";

// echo $text[1];

// function chekString(string $string):bool {
//   $count = 0;
//   for ($i=0; $i < strlen($string) ; $i++) { 
//     if ($string[$i] === "(") {
//       $count++;
//     }
//     if ($string[$i] === ")") {
//       $count--;
//     }
//   }
//   if ($count < 0) {
//     return false;
//   }
//   return $count === 0;
// }

// //var_dump(chekString($text));
// echo chekString($text) ? "Строка валидна" : "Ошибка";