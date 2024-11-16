<?php

namespace Geekbarins\Application1\Domain\Controllers;

use Geekbarins\Application1\Domain\Models\SiteInfo;
use Geekbarins\Application1\Application\Render;

class SiteController {
  
  public function actionInfo(){
    $siteInfo = new SiteInfo();
    $render = new Render();

    if(!$siteInfo){
      return $render->renderPage(
          'user-empty.twig', 
          [
              'title' => 'Информация о сайте',
              'message' => "Информация не найдена или недоступна"
          ]);
  }
  else{
      return $render->renderPage(
          'site-info.twig',
          [
              'title' => 'Информация о сайте',
              'server' => $siteInfo->getServer(),
              'phpVersion' => $siteInfo->getPhpVersion(),
              'browserVersion' => $siteInfo->getBrowserVersion()
          ]);
  }
  }
}