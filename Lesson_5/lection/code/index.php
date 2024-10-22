<?php

require_once "./vendor/autoload.php";

use Geekbarins\Application1\Application;

$app = new Application;
echo $app->run();