<?php

namespace Geekbarins\Application1;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Render {

  private string $viewfolder = '/src/Views';

  private FilesystemLoader $loader;
  private Environment $environment;

  public function __construct(){
    $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $this->viewfolder);
    
    $this->environment = new Environment($this->loader, [
      'cache' => $_SERVER['DOCUMENT_ROOT'],'/cache/',
    ]);
  }

  public function renderPage (){
    $template = $this->environment->load('main.tpl');
    return $template->render(['title' => "Title for my site"]);
  }
}