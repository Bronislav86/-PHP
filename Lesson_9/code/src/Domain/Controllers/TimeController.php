<?php

namespace Geekbrains\Application1\Domain\Controllers;

date_default_timezone_set('Europe/Moscow');

class TimeController
{

  public function actionIndex(): string
  {
    $result = json_encode(date("H:i:s"), JSON_UNESCAPED_UNICODE);

    if (ob_get_contents()) {
      ob_clean();
    }

    return $result;
  }
}
