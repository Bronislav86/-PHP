<?php
$students = [
  [
    'name' => 'Иван',
    'score' => 4.5,
  ],
  [
    'name' => 'Мария',
    'score' => 5,
  ],
  [
    'name' => 'Петр',
    'score' => 3.7,
  ]
];

$sum = 0;

for ($i=0; $i < count($students); $i++) { 
  $sum += $students[$i]['score'];
}

echo 'Средний балл: ' . $sum / count($students);