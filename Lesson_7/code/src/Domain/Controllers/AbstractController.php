<?php

namespace Geekbarins\Application1\Domain\Controllers;

use Geekbarins\Application1\Application\Application;

class AbstractController {

  protected array $actionsPermissions = [];

public function getUserRoles(): array{
  $roles = [];

  if (isset($_SESSION['user_id'])) {
    $rolesSql = "SELECT * FROM user_roles WHERE user_id = :id";

    $handler = Application::$storage->get()->prepare($rolesSql);
    $handler->execute(['id' => $_SESSION['user_id']]);
    $result = $handler->fetchAll();

    if (!empty($result)) {
      foreach ($result as $role) {
        $roles[] = $role['role'];
      }
    }

  }
  return $roles;
}

public function getActionsPermissions(string $methodName): array {
  return isset($this->actionsPermissions[$methodName]) ? $this->actionsPermissions[$methodName] : [];
}

}