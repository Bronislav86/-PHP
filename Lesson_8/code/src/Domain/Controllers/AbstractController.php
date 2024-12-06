<?php

namespace Geekbarins\Application1\Domain\Controllers;

use Geekbarins\Application1\Application\Application;

abstract class AbstractController
{

  protected array $actionsPermissions = [];

  protected array $alwaysEnabledMethods = [];

  public function __construct()
  {
    if (!isset($_SESSION['pageCounter'])) {
      $_SESSION['pageCounter'] = 0;
    }
    $_SESSION['pageCounter']++;
  }


  public function getUserRoles(): array
  {
    $roles = [];

    if (isset($_SESSION['auth']['user_id'])) {
      $rolesSql = "SELECT * FROM user_roles WHERE user_id = :id";

      $handler = Application::$storage->get()->prepare($rolesSql);
      $handler->execute(['id' => $_SESSION['auth']['user_id']]);
      $result = $handler->fetchAll();

      if (!empty($result)) {
        foreach ($result as $role) {
          $roles[] = $role['role'];
        }
      } else {
        $roles[] = 'user';
      }
    }
    return $roles;
  }

  public function getActionsPermissions(string $methodName): array
  {
    return isset($this->actionsPermissions[$methodName]) ? $this->actionsPermissions[$methodName] : [];
  }

  public function isAlwaysEnabled(string $methodName): bool
  {
    return in_array($methodName, $this->alwaysEnabledMethods);
  }
}
