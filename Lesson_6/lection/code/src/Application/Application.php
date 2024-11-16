<?php

namespace Geekbarins\Application1\Application;

use Geekbarins\Application1\Infrastructure\Config;
use Geekbarins\Application1\Infrastructure\Storage;

final class Application {

    private const APP_NAMESPACE = 'Geekbarins\Application1\Domain\Controllers\\';

    private string $controllerName;
    private string $methodName;
    public static Config $config;
    public static Storage $storage;

    public function __construct()
    {
        Application::$config = new Config();
        Application::$storage = new Storage();
    }

    public function run() : string {
        //Application::$config = parse_ini_file('config.ini', true);

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
                return call_user_func_array(
                    [$controllerInstance, $this->methodName],
                    []
                );
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

}