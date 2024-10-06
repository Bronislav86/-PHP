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

function getAverageScore (array $studentsArray = []) : float {
  $sum = 0;

  foreach ($studentsArray as $student) {
    $sum += $student['score'];
  }

  return $sum / count($studentsArray);
}

echo getAverageScore($students);