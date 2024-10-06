<?php
$a = 5;
$b = 6;

$masseg = ($a > $b) ? 'Привет малой' : 'Привет старик';

echo($masseg);

$value = 'Burger';

$result = match ($value) {
  'Hot Dog'=> 'Выбран Хот-Дог',
  'Cola'=> 'Выбрана кола',
  'Burger' => 'Выбран бургер',
};

echo($result);

$array = ['foo', 'bar', 'baz'];

echo $array[2];
$student = array(
  'name' => 'Иван',
  'age' => 18,
  'email' => 'johnDeer@mal.ru'
);

echo $student['name'];
$counter = 0;
$sum = 0;
while ($counter < count($student)) {
  $sum += 1;
  $counter++;
}

for ($i=0; $i < count($student); $i++) { 
  $sum++;
};