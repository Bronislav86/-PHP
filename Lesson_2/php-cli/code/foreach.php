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

foreach ($students as $key => $value) {
  echo $key . " " . $value['name'] . "\r\n";
};