<?php

namespace Geekbarins\Application1\Application;

use Geekbarins\Application1\Infrastructure\Config;
use Geekbarins\Application1\Infrastructure\Storage;
use Geekbarins\Application1\Application\Auth;
use Geekbarins\Application1\Domain\Controllers\AbstractController;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Level;

final class Application
{

    private const APP_NAMESPACE = 'Geekbarins\Application1\Domain\Controllers\\';

    private string $controllerName;
    private string $methodName;
    public static Config $config;
    public static Storage $storage;
    public static Auth $auth;
    public static Logger $logger;

    public function __construct()
    {
        Application::$config = new Config();
        Application::$storage = new Storage();
        Application::$auth = new Auth();
        Application::$logger = new Logger('application_logger');
        Application::$logger->pushHandler(
            new StreamHandler(
                $_SERVER['DOCUMENT_ROOT'] . "/log/" . Application::$config->get()['log']['LOGS_FILE'] . "-" . date("Y-m-d") . ".log",
                Level::Debug
            )
        );

        Application::$logger->pushHandler(new FirePHPHandler());
    }

    public function runApp(): string
    {
        $memoryStart = memory_get_usage();

        $result = $this->run();

        $memoryEnd = memory_get_usage();
        //добавить проверку конфига на true в логировании БД
        $this->saveMemoryLog($memoryEnd - $memoryStart);

        return $result;
    }

    private function saveMemoryLog(int $memory): void
    {
        $logSql = "INSERT INTO memory_log(user_agent, log_datetime, url, memory_volume)
                    VALUES (:user_agent, :log_datetime, :url, :memory_volume)";

        $handler = Application::$storage->get()->prepare($logSql);
        $handler->execute([
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'log_datetime' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
            'url' => $_SERVER['REQUEST_URI'],
            'memory_volume' => $memory
        ]);
    }

    public function run(): string
    {
        //Application::$config = parse_ini_file('config.ini', true);

        session_start();
        Application::$auth->restoreSession();

        $routeArray = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($routeArray[1]) && $routeArray[1] != '') {
            $controllerName = $routeArray[1];
        } else {
            $controllerName = "page";
        }

        $this->controllerName = Application::APP_NAMESPACE . ucfirst($controllerName) . "Controller";

        if (class_exists($this->controllerName)) {
            // пытаемся вызвать метод
            if (isset($routeArray[2]) && $routeArray[2] != '') {
                $methodName = $routeArray[2];
            } else {
                $methodName = "index";
            }

            $this->methodName = "action" . ucfirst($methodName);

            if (method_exists($this->controllerName, $this->methodName)) {
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
                } else {
                    return call_user_func_array(
                        [$controllerInstance, $this->methodName],
                        []
                    );
                }
            } else {
                $logMessage = 'Метод ' . $this->methodName . " в контроллере" . $this->controllerName . " | ";
                $logMessage .= "Попытка вызова адреса" . $_SERVER['REQUEST_URI'];
                Application::$logger->error($logMessage);

                header("HTTP/1.1 404 Not Found");
                header("Location: /404.html");
                die();
                return "Метод не существует";
            }
        } else {
            header("HTTP/1.1 404 Not Found");
            header("Location: /404.html");
            die();
            // return "Класс $this->controllerName не существует";
        }
    }

    public static function config(): array
    {
        return Application::$config->get();
    }

    public function checkAccessToMethod(AbstractController $controllerInstance, string $methodName): bool
    {
        $userRoles = $controllerInstance->getUserRoles();

        $roles = $controllerInstance->getActionsPermissions($methodName);

        $roles[] = 'user';

        $isAllowed = false;

        if (!empty($roles)) {
            foreach ($roles as $rolePermission) {
                if (in_array($rolePermission, $userRoles)) {
                    $isAllowed = true;
                    break;
                }
            }
        } else {
            $isAllowed = true;
        }
        return true;
        return $isAllowed;
    }

    private function getRouteArray(): array
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }
}
