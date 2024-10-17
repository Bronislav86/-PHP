<?php

//подключение файлов логики
//require_once('src/main.function.php');
//require_once('src/template.function.php');
//require_once('src/file.function.php');

require_once __DIR__ . '/vendor/autoload.php';


//вызов корневой функции
$result = main(__DIR__ . "/config.ini");
//вывод результата
echo $result;

//запуск приложения:
//docker run -it -v ${pwd}/Lesson_3/php-cli/lection:/lection/ php-gb php app.php read-all