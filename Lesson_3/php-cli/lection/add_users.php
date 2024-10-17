<?php
$address = '/lection/file.txt';

$name = readline('Введите имя: ');
$date = readline("Введите дату рождения в формате дд.мм.гггг: ");

$data = $name . ", " . $date . "\r\n";

$filehandler = fopen($address, 'a');

if (fwrite($filehandler, $data)) {
  echo "Запись $data добавлениа в файл $address";
} else {
  echo "Произошла ошибка записи. Данные не сохранены";
}

fclose($filehandler);