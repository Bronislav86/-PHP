<?php

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