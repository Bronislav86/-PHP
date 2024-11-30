<?php

session_start([
  'cookie_lifetime' => 86400,
  'read_and_close'  => true,
]);

$_SESSION['login'] = 'admin';

echo $_SESSION['login'] = 'admin';

var_dump($_SESSION);