<?php

namespace Geekbarins\Application1\Domain\Controllers;

use Geekbarins\Application1\Application\Render;
use Geekbarins\Application1\Domain\Models\User;
use Exception;

class UserController {

public function actionIndex() {
    $users = User::getAllUsersFromStorage();
    
    $render = new Render();

    if(!$users){
        return $render->renderPage(
            'user-empty.twig', 
            [
                'title' => 'Список пользователей в хранилище',
                'message' => "Список пуст или не найден"
            ]);
    }
    else{
        return $render->renderPage(
            'user-index.twig', 
            [
                'title' => 'Список пользователей в хранилище',
                'users' => $users
            ]);
    }
}
// ------------------------------------метод сохранения данных в файл
// public function actionSave() {
//     $address = './storage/birthdays.txt';

//     $name = $_GET['name'];

//     $date = $_GET['birthday'];

//     $data = "\r\n" . $name . ", " . $date;

//     $fileHendler = fopen($address, 'a');

//     if (fwrite($fileHendler, $data)) {
//         return "Запись $data добавлена в файл $address";
//     }
//     else {
//         return "Произошла ошибка записи. Данные не сохранены";
//     }
// }

public function actionSave(): string {
    if (User::validateRequestData()) {
        $user = new User();
        $user->setParamsFromRequestData();
        $user->saveToStorage();

        $render = new Render();

        return $render->renderPage(
            'user-created.twig', 
            [
                'title' => 'Пользователь создан',
                'message' => 'Создан пользователь ' . $user->getUserName() . " " . $user->getUserLastName()
            ]);
    }
    else {
        throw new Exception("Переданные данные не корректны");
    }
}

public function actionDelete(): string{
    
    if (User::exists($_GET['id'])) {
        $user = User::getUserFromStorageById($_GET['id']);
        $user::deleteFromStorage($_GET['id']);

        $render = new Render();

        return $render->renderPage(
            'user-removed.twig' , [
                'title' => 'Страница удаления пользователей',
                'message' => 'Пользователь ' . $user->getUserName() . ' был успешно удален'
            ]
        );
    } else {
        throw new Exception ('Пользователь не существует');
    }
}

public function actionShow (){

    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

    if (User::exists($id)) {
        $user = User::getUserFromStorageById($id);
        $render = new Render();
        return $render->renderPage('user-show.twig', 
        [
            'user' => $user
        ]);
    } else {
        throw new Exception('Пользователь не существует');
    }
}

public function actionUpdate () {
    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
    $name = isset($_GET['name']) ? (string)$_GET['name'] : 0;

    if (User::exists($id) && $name !== 0) {
        $user = User::updateFromStorage($id, $name);
        $user = User::getUserFromStorageById($id);
        $render = new Render();
        return $render->renderPage('user-created.twig',
        [
            'message' => 'Пользователь c ID: ' . $user->getUserId() . ' был успешно обновлен.'
        ]);
    } else {
        throw new Exception ('Пользваотель с заданым ID не найден');
    }
}

}