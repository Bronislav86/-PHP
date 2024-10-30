<?php

namespace Geekbarins\Application1\Controllers;

use Geekbarins\Application1\Models\SiteInfo;
use Geekbarins\Application1\Render;

class SiteController {
  
  public function actionInfo(){
    $siteInfo = new SiteInfo();
    $render = new Render();

    if(!$siteInfo){
      return $render->renderPage(
          'user-empty.tpl', 
          [
              'title' => 'Информация о сайте',
              'message' => "Информация не найдена или недоступна"
          ]);
  }
  else{
      return $render->renderPage(
          'site-info.tpl',
          [
              'title' => 'Информация о сайте',
              'server' => $siteInfo->getServer(),
              'phpVersion' => $siteInfo->getPhpVersion(),
              'browserVersion' => $siteInfo->getBrowserVersion()
          ]);
  }
  }
}