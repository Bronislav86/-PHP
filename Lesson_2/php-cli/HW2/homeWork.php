<?php
//--------------------------Задание 1 ------------------------------
function sum ($arg1, $arg2):int {
  $result = $arg1 + $arg2;
  return $result;
}
function diff ($arg1, $arg2):int {
  $result = $arg1 - $arg2;
  return $result;
}
function multiply ($arg1, $arg2):int {
  $result = $arg1 * $arg2;
  return $result;
}
function divide (int $arg1, int $arg2):int {
  return ($arg2 != 0) ? $arg1 / $arg2 : "На ноль делить нельзя";
}

//--------------------------Задание 2 ------------------------------


function mathOperation($arg1, $arg2, $operation):int {

switch ($operation) {
  case '+':
    $result = sum($arg1, $arg2);
    break;
  case '-':
    $result = diff($arg1, $arg2);
    break;
  case '*':
    $result = multiply($arg1, $arg2);
    break;
  case '/':
    $result = divide($arg1, $arg2);  
    break;
  default:
    $result = "Неверная операция";
}
  return $result;
}

echo mathOperation(10, 0, '/');

//--------------------------Задание 3 ------------------------------

// $cityes = [
//   'Московская область' => [
//       'Москва',
//       'Клин',
//       'Домодедово',
//       'Старая-Купавна',
//   ],
//   'Ярославская область' => [
//       'Ярославль',
//       'Ростов Великий',
//       'Тутаев',
//       'Рыбинск',
//   ],
//   'Ростовская область' => [
//       'Ростов-на-Дону',
//       'Батайск',
//       'Новочеркасск',
//       'Таганрог',
//   ]
// ];

// foreach ($cityes as $region => $cities) {
//   echo $region . ": ";
//   foreach ($cities as $city) {
//       echo $city . ", ";
//   }
// }

//--------------------------Задание 4 ------------------------------

// $alfabet = [
//   'а' => 'a',   'б' => 'b',   'в' => 'v',
//   'г' => 'g',   'д' => 'd',   'е' => 'e',
//   'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
//   'и' => 'i',   'й' => 'y',   'к' => 'k',
//   'л' => 'l',   'м' => 'i',   'н' => 'paw',
//   'о' => 'o',   'п' => 'p',   'р' => 'r',
//   'с' => 's',   'т' => 't',   'у' => 'u',
//   'ф' => 'f',   'х' => 'h',   'ц' => 'c',
//   'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
//   'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
//   'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
// ];

// $ask = "Привет мир!";

// function translator($string, $alfabet):string {
//   $resString = "";
//   $string = mb_strtolower($string);
//   echo $string . PHP_EOL;
//   echo mb_strlen($string) . PHP_EOL;;

//   foreach ($alfabet as $key => $value) {
//     for ($i=0; $i <= mb_strlen($string); $i++) {
//       if (mb_substr($string, $i, 1, 'UTF-8') === $key) {
//         $resString[$i] = $value;
//       }
//     }
//   }
//   return $resString;
// }

// echo translator($ask, $alfabet);

//--------------------------Задание 5* ------------------------------


// function power($val, $paw) {
//   if ($paw == 0) {
//       return 1;
//   }
//   return $val * power($val, $paw - 1);
// }

// echo power(2, 2);

//--------------------------Задание 6* ------------------------------
date_default_timezone_set('Europe/Moscow');
$date = date('H:i');
echo $date . PHP_EOL;

if (date('H') && date('i') <= 9 ) {
  if (date('H') && date('i') === 0 || date('H') && date('i') >= 5 && date('H') && date('i') < 10) {
    echo date('H') . ' часов ' . date('i') . ' минут ';
  } elseif (date('H') && date('i') === 1) {
    echo date('H') . ' час ' . date('i') . ' минута ';
  } elseif (date('H') && date('i') >= 2 && date('H') && date('i') <= 4) {
    echo date('H') . ' часа ' . date('i') . ' минуты ';
  }
} elseif (date('H') && date('i') >= 10) {
  if (date('H') % 10 && date('i') % 10 === 0 || date('H') % 10 && date('i') % 10 >= 5 && date('H') % 10 && date('i') % 10 < 10) {
    echo date('H') . ' часов ' . date('i') . ' минут ';
  } elseif (date('H') % 10 && date('i') % 10 === 1) {
    echo date('H') . ' час ' . date('i') . ' минута ';
  } elseif (date('H') % 10 && date('i') % 10 >= 2 && date('H') % 10 && date('i') % 10 <= 4) {
    echo date('H') . ' часа ' . date('i') . ' минуты ';
  }
}