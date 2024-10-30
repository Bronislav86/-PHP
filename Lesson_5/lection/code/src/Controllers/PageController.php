<?php

namespace Geekbarins\Application1\Controllers;

use DateTimeZone;
use Geekbarins\Application1\Application;
use Geekbarins\Application1\Render;

date_default_timezone_set('Europe/Moscow');

class PageController {

    public function actionIndex() {
        $render = new Render();
        echo Application::config()["storage"]["address"];
        
        return $render->renderPage('page-index.tpl', [
            'title' => 'Главная страница',
            'time' => date('H:i:s')
        ]);
    }
}