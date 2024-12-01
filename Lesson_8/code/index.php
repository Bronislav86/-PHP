<?php

$memoryStart = memory_get_usage();

require_once "./vendor/autoload.php";

use Geekbarins\Application1\Application\Application;
use Geekbarins\Application1\Application\Render;

try {
  $app = new Application();
  echo $app->run();
}
catch(Exception $exception) {
  echo Render::renderExceptionPage($exception);
}

$memmoryEnd = memory_get_usage();

echo"<h4>Потреблено " . (($memmoryEnd - $memoryStart) / 1024 / 1024) . " МБ памяти</h4>";