<?php

namespace Geekbarins\Application1\Controllers;

use Geekbarins\Application1\Render;
use Geekbarins\Application1\Models\User;

class UserController {

  public function actionIndex() {
      $users = User::getAllUsersFromStorage();
      
      $render = new Render();

      if(!$users){
          return $render->renderPage(
              'user-empty.tpl', 
              [
                  'title' => 'Список пользователей в хранилище',
                  'message' => "Список пуст или не найден"
              ]);
      }
      else{
          return $render->renderPage(
              'user-index.tpl', 
              [
                  'title' => 'Список пользователей в хранилище',
                  'users' => $users
              ]);
      }
  }
}