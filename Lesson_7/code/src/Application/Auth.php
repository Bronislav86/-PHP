<?php

namespace Geekbarins\Application1\Application;

class Auth {
  public static function getPasswordHash(string $password): string {
    return password_hash($_GET['pass_string'], PASSWORD_BCRYPT);
  }

  public function proceedAuth(string $login, string $password): bool {
    $sql = "SELECT user_id, user_name, user_lastname, password_hash FROM Users WHERE login = :login";

    $handler = Application::$storage->get()->prepare($sql);
    $handler->execute(['login' => $login]);
    $result = $handler->fetchAll();

    if (!empty($result) && password_verify($password, $result[0]['password_hash'])) {
      $_SESSION['user_name'] = $result[0]['user_name'];
      $_SESSION['user_lastname'] = $result[0]['user_lastname'];
      $_SESSION['user_id'] = $result[0]['user_id'];

      return true;
    }
    else {
      return false;
    }
  }
}