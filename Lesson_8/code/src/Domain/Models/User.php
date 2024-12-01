<?php

namespace Geekbarins\Application1\Domain\Models;

use Geekbarins\Application1\Application\Application;
use Geekbarins\Application1\Infrastructure\Storage;
use Geekbarins\Application1\Application\Auth;
use PDO;

class User
{

    private ?int $userId;
    private ?string $user_login;
    private ?string $userName;
    private ?string $userLastName;
    private ?int $userBirthday;

    private static string $storageAddress = '/storage/birthdays.txt';

    public function __construct(int $userId = null, string $login = null, string $name = null, string $userLastName = null, int $birthday = null,)
    {
        $this->userId = $userId;
        $this->user_login = $login;
        $this->userName = $name;
        $this->userLastName = $userLastName;
        $this->userBirthday = $birthday;
    }

    //private ?string $userPasswordHash;
    private ?string $userRole;

    public function setName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function setUserLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    public function setUserId(int $id_user): void
    {
        $this->userId = $id_user;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserLogin(int $userLogin): void
    {
        $this->user_login = $userLogin;
    }
    public function getUserLogin(): ?string
    {
        return $this->user_login;
    }

    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserBirthday(): ?int
    {
        return $this->userBirthday;
    }

    // public function setPasswordHash(string $userPasswordHash) : void {
    //     $this->userPasswordHash = $userPasswordHash;
    // }
    // public function getUserPasswordHash(): string {
    //     return $this->userPasswordHash;
    // }
    public function setUserRole(string $userRole): void
    {
        $this->userRole = $userRole;
    }
    public function getUserRole(): string
    {
        return $this->userRole;
    }

    public function setBirthdayFromString(?string $birthdayString): void
    {
        $this->userBirthday = strtotime($birthdayString);
    }

    public function __toString(): string
    {
        return sprintf(
            'User: %s %s (ID: %d, Birthday: %d)',
            $this->userName,
            $this->userLastName,
            $this->userId,
            $this->userBirthday
        );
    }

    public static function getUserFromStorageById(int $id): User
    {
        $sql = 'SELECT * FROM users WHERE user_id = :id';

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $id]);

        $result = $handler->fetchAll();
        return new User(
            $result[0]["user_id"],
            $result[0]["user_name"],
            $result[0]["user_lastname"],
            $result[0]["user_birthday_timestamp"]
        );
    }

    public static function exists(int $id): bool
    {

        // SQL-запрос для проверки существования записи
        $sql = "SELECT COUNT(user_id) as user_count FROM users WHERE user_id = :id";

        // Подготовка и выполнение запроса
        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute(['id' => $id]);

        // Получаем количество найденных записей
        $count = $handler->fetchColumn();

        // Если количество больше 0, запись существует
        return $count > 0;
    }

    public static function getAllUsersFromStorage(): array|false
    {
        $sql = "SELECT * FROM users";

        $handler = Application::$storage->get()->prepare($sql);
        $handler->execute();

        $result = $handler->fetchAll();
        $users = [];

        foreach ($result as $item) {
            $user = new User($item['user_id'], $item['login'], $item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp']);
            $users[] = $user;
        }

        return $users;
    }

    public static function validateRequestData(): bool
    {
        $result = true;

        if (!(isset($_POST['login']) && !empty($_POST['login']) &&
            isset($_POST['lastname']) && !empty($_POST['lastname']) &&
            isset($_POST['birthday']) && !empty($_POST['birthday'])
        )) {
            $result = false;
        }

        if (preg_match('/<([^>]+)>/', $_POST['name']) || preg_match('/<([^>]+)>/', $_POST['lastname'])) {
            $result = false;
        }

        if (preg_match('/^(\d{2}-\d{2}-\d{4})$/', $_POST['birthday'])) {
            $result = false;
        }

        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] != $_POST['csrf_token']) {
            $result = false;
        }

        return $result;
    }

    public function setParamsFromRequestData(): void
    {
        if ($_POST['id'] != '') {
            $this->userId = htmlspecialchars($_POST['id']);
        }
        $this->user_login = htmlspecialchars($_POST['login']);
        $this->userName = htmlspecialchars($_POST['name']);
        $this->userLastName = htmlspecialchars($_POST['lastname']);
        $this->setBirthdayFromString($_POST['birthday']);
        //$this->userPasswordHash = Auth::getPasswordHash($_POST['password']);
        $this->userRole = "guest";
    }

    public function saveToStorage(): void
    {
        $storage = new Storage();

        $sql = 'INSERT INTO users( user_name, user_lastname, user_birthday_timestamp, user_login) VALUES (:user_name, :user_lastname, :user_birthday, :login)';

        $handler = $storage->get()->prepare($sql);

        $handler->execute([
            'user_name' => $this->userName,
            'user_lastname' => $this->userLastName,
            'user_birthday' => $this->userBirthday,
            'login' => $this->user_login

        ]);
    }

    public static function deleteFromStorage(int $id): void
    {
        //сначала удаляем записи из связанных таблиц
        $sqlDeletePayments = "DELETE FROM payments WHERE user_id = :user_id";
        $handlerPayments = Application::$storage->get()->prepare($sqlDeletePayments);
        $handlerPayments->execute(['user_id' => $id]);

        // Запрос для удаления пользователя по id
        $sql = "DELETE FROM users WHERE user_id = :id";

        // Подготовка запроса
        $handler = Application::$storage->get()->prepare($sql);

        // Выполнение запроса с параметром id
        $handler->execute([
            'id' => $id
        ]);
    }

    public static function updateFromStorage(int $id, string $u_name): void
    {

        $updateSql = "UPDATE Users SET user_name = :u_name WHERE user_id = :u_id";
        $handler = Application::$storage->get()->prepare($updateSql);
        $handler->execute([
            'u_name' => $u_name,
            'u_id' => $id
        ]);
    }

    public static function destroyToken(): array
    {
        $userSql = 'UPDATE users SET token = :token WHERE user_id = :id';

        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['token' => md5(bin2hex(random_bytes(16))), 'id' => $_SESSION['auth']['user_id']]);
        $result = $handler->fetchAll();

        return $result[0] ?? [];
    }

    public static function verifyToken(string $token): array
    {
        $userSql = "SELECT * FROM users WHERE token = :token";


        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['token' => $token]);
        $result = $handler->fetchAll();

        return $result[0] ?? [];
    }

    public static function setToken(int $userID, string $token): void
    {
        $userSql = "UPDATE users SET token = :token WHERE user_id = :id";


        $handler = Application::$storage->get()->prepare($userSql);
        $handler->execute(['id' => $userID, 'token' => $token]);


        setcookie(
            'auth_token',
            $token,
            time() + 60 * 60 * 24 * 30,
            '/'
        );
    }
}
