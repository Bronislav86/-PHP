<?php

namespace Geekbarins\Application1\Domain\Models;

use Geekbarins\Application1\Application\Application;
use Geekbarins\Application1\Infrastructure\Storage;
use PDO;

class User {

private ?int $userId;
private ?string $userName;
private ?string $userLastName;
private ?int $userBirthday;

private static string $storageAddress = '/storage/birthdays.txt';

public function __construct(int $userId = null, string $name = null, string $userLastName = null, int $birthday = null, ){
    $this->userId = $userId;
    $this->userName = $name;
    $this->userLastName = $userLastName;
    $this->userBirthday = $birthday;
    
}

public function setName(string $userName) : void {
    $this->userName = $userName;
}

public function setUserLastName(string $userLastName): void {
    $this->userLastName = $userLastName;
}

public function setUserId (int $id_user) : void {
    $this->userId = $id_user;
}

public function getUserId () : ?int {
    return $this->userId;
}

public function getUserLastName():string{
    return $this->userLastName;
}

public function getUserName(): string {
    return $this->userName;
}

public function getUserBirthday(): int {
    return $this->userBirthday;
}

public function setBirthdayFromString(?string $birthdayString) : void {
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

public static function getUserFromStorageById(int $id): User {
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

public static function exists(int $id): bool{
    $storage = new Storage();

    // SQL-запрос для проверки существования записи
    $sql = "SELECT COUNT(*) FROM users WHERE user_id = :id";

    // Подготовка и выполнение запроса
    $handler = $storage->get()->prepare($sql);
    $handler->execute(['id' => $id]);

    // Получаем количество найденных записей
    $count = $handler->fetchColumn();

    // Если количество больше 0, запись существует
    return $count > 0;

}

public static function getAllUsersFromStorage(): array|false {
    $sql = "SELECT * FROM USERS";
    
    $handler = Application::$storage->get()->prepare($sql);
    $handler->execute();

    $result = $handler->fetchAll();
    $users = [];

    foreach ($result as $item) {
        $user = new User($item['user_id'], $item['user_name'], $item['user_lastname'], $item['user_birthday_timestamp']);
        $users[] = $user;
    }

    return $users;
}

public static function validateRequestData():bool{
    if (isset($_GET['name']) && !empty($_GET['name']) &&
        isset($_GET['lastname']) && !empty($_GET['lastname']) &&
        isset($_GET['birthday']) && !empty($_GET['birthday'])) {
        return true;
    }
    else {
        return false;
    }
}

public function setParamsFromRequestData():void {
    $this->userName = $_GET['name'];
    $this->userLastName = $_GET['lastname'];
    $this->setBirthdayFromString($_GET['birthday']);
}

public function saveToStorage(): void {
    $storage = new Storage();

    $sql = "INSERT INTO users(user_name, user_lastname, user_birthday_timestamp) VALUES (:user_name, :user_lastname, :user_birthday)";

    $handler = $storage->get()->prepare($sql);

    $handler->execute([
        'user_name' => $this->userName,
        'user_lastname' => $this->userLastName,
        'user_birthday' => $this->userBirthday

    ]);
}

public static function deleteFromStorage(int $id): void {
    $storage = new Storage();

    //сначала удаляем записи из связанных таблиц
    $sqlDeletePayments = "DELETE FROM payments WHERE user_id = :user_id";
    $handlerPayments = $storage->get()->prepare($sqlDeletePayments);
    $handlerPayments->execute(['user_id' => $id]);

    // Запрос для удаления пользователя по id
    $sql = "DELETE FROM users WHERE user_id = :id";

    // Подготовка запроса
    $handler = $storage->get()->prepare($sql);

    // Выполнение запроса с параметром id
    $handler->execute([
        'id' => $id
    ]);
}

public static function updateFromStorage(int $id, string $u_name): void {

    $storage = new Storage();

    $updateSql = "UPDATE Users SET user_name = :u_name WHERE user_id = :u_id";
    $handler = $storage->get()->prepare($updateSql);
    $handler->execute([
        'u_name'=> $u_name,
        'u_id' => $id
    ]);
}

}