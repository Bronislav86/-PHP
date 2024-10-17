<?php

function handleError(string $errorText) : string {
  return "\033[31m" . $errorText . "\r\n \033[97m";
}

function handleHelp() : string {
  $help = "Програма работы с файловым хранилищем \r\n";

  $help .= "Порядок вызова\r\n\r\n";

  $help .= "php /lection/app.php [COMMAND] \r\n\r\n";

  $help .= "Доступные команды \r\n";
  $help .= "read-all - чтение всего файла \r\n";
  $help .= "clear - очистка файла \r\n";
  $help .= "help - помощь \r\n";

  return $help;
}