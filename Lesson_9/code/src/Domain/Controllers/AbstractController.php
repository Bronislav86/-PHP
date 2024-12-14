<?php

namespace Geekbrains\Application1\Domain\Controllers;

use Geekbrains\Application1\Application\Application;

class AbstractController
{

    protected array $actionsPermissions = [];

    public function getUserRoles(): array
    {
        $roles = [];

        if (isset($_SESSION['user_id'])) {
            $rolesSql = "SELECT * FROM user_roles WHERE id_user = :id";
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

    public function getActionsPermissions(string $methodName): array
    {
        return isset($this->actionsPermissions[$methodName]) ? $this->actionsPermissions[$methodName] : [];
    }
}
