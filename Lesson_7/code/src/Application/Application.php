<?php

namespace Geekbarins\Application1\Application;

use Geekbarins\Application1\Infrastructure\Config;
use Geekbarins\Application1\Infrastructure\Storage;
use Geekbarins\Application1\Application\Auth;
use Geekbarins\Application1\Domain\Controllers\AbstractController;

final class Application {

    private const APP_NAMESPACE = 'Geekbarins\Application1\Domain\Controllers\\';

    private string $controllerName;
    private string $methodName;
    public static Config $config;
    public static Storage $storage;
    public static Auth $auth;

    public function __construct()
    {
        Application::$config = new Config();
        Application::$storage = new Storage();
        Application::$auth = new Auth();
    }

    public function run() : string {
        //Application::$config = parse_ini_file('config.ini', true);

        session_start();
        Application::$auth->restoreSession();

        $routeArray = explode('/', $_SERVER['REQUEST_URI']);

        if(isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        }
        else{
            $controllerName = "page";
        }

        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";

        if(class_exists($this->controllerName)){
            // пытаемся вызвать метод
            if(isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            }
            else {
                $methodName = "index";
            }

            $this->methodName = "action" . ucfirst($methodName);

            if(method_exists($this->controllerName, $this->methodName)){
                $controllerInstance = new $this->controllerName();

                if ($controllerInstance instanceof AbstractController) {
                        if ($this->checkAccessToMethod($controllerInstance, $this->methodName)) {
                        return call_user_func_array(
                            [$controllerInstance, $this->methodName],
                            []
                        );
                    } else {
                        return "Нет доступа к методу";
                    }
                }
                else {
                    return call_user_func_array(
                        [$controllerInstance, $this->methodName],
                        []
                    );
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                header("Location: /404.html");
                die();
                return "Метод не существует";
            }
        }
        else{
            header("HTTP/1.1 404 Not Found");
            header("Location: /404.html");
            die();
            // return "Класс $this->controllerName не существует";
        }
    }

    public static function config(): array{
        return Application::$config->get();
    }

    public function checkAccessToMethod(AbstractController $controllerInstance, string $methodName): bool {
        $userRoles = $controllerInstance->getUserRoles();

        $roles = $controllerInstance->getActionsPermissions($methodName);

        $roles[] = 'user';

        $isAllowed = false;

        if (!empty($roles)) {
            foreach ($roles as $rolePermission) {
                if(in_array($rolePermission, $userRoles)){
                    $isAllowed = true;
                    break;
                }
            }
        }
        return true;
        return $isAllowed;
    }
    
    private function getRouteArray() : array {
        return explode('/', $_SERVER['REQUEST_URI']);
    }
}