<?php

namespace Geekbarins\Application1\Application;

use Geekbarins\Application1\Domain\Models\User;
use Geekbarins\Application1\Application\Application;

class Auth
{
  public static function getPasswordHash(string $password): string
  {
    return password_hash($_GET['pass_string'], PASSWORD_BCRYPT);
  }

  public function restoreSession(): void
  {
    if (isset($_COOKIE['auth_token']) && !isset($_SESSION['auth']['user_name'])) {
      $userData = User::verifyToken($_COOKIE['auth_token']);
    }

    if (!empty($userData)) {
      $_SESSION['auth']['user_name'] = $userData['user_name'];
      $_SESSION['auth']['user_lastname'] = $userData['user_lastname'];
      $_SESSION['auth']['user_id'] = $userData['user_id'];
    }
  }

  public function generateToken(int $userId): string
  {
    $bytes = random_bytes(16);
    return bin2hex($bytes);
  }

  public function proceedAuth(string $login, string $password): bool
  {
    $sql = "SELECT user_id, user_name, user_lastname, password_hash FROM users WHERE login = :login";

    $handler = Application::$storage->get()->prepare($sql);
    $handler->execute(['login' => $login]);
    $result = $handler->fetchAll();

    if (!empty($result) && password_verify($password, $result[0]['password_hash'])) {
      $_SESSION['auth']['user_name'] = $result[0]['user_name'];
      $_SESSION['auth']['user_lastname'] = $result[0]['user_lastname'];
      $_SESSION['auth']['user_id'] = $result[0]['user_id'];

      return true;
    } else {
      return false;
    }
  }

  public static function addSessionData(array $templateVariables): array
  {
    if (isset($_SESSION['user_name'])) {
      $templateVariables['islogin'] = true;
      $templateVariables['username'] = $_SESSION['user_name'] . ' ' . $_SESSION['user_lastname'];
    }
    return $templateVariables;
  }

  public function isLogin(): bool
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    return !empty($_SESSION['user_id']);
  }
}
