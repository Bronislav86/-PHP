<?php

namespace Geekbarins\Application1\Domain\Controllers;

use DateTimeZone;
use Geekbarins\Application1\Application\Application;
use Geekbarins\Application1\Application\Render;

date_default_timezone_set('Europe/Moscow');

class PageController {

    public function actionIndex() {
        $render = new Render();
        // echo Application::config()["database"]["USER"] . PHP_EOL;
        // echo Application::config()["database"]["PASSWORD"];
        
        return $render->renderPage('page-index.twig', [
            'title' => 'Главная страница',
            'time' => date('H:i:s')
        ]);
    }
}