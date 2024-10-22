<?php
namespace Geekbarins\Application1\Controllers;

use Geekbarins\Application1\Render;

class PageController {

  public function actionIndex(){
    $render = new Render();


    return $render->renderPage();
  }
}