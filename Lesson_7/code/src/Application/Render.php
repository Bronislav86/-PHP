<?php

namespace Geekbarins\Application1\Application;

use Exception;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Render {

    private string $viewFolder = '/src/Domain/Views/';
    private FilesystemLoader $loader;
    private Environment $environment;


    public function __construct(){
        $this->loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            //'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);
    }

    public function renderPage(string $contentTemplateName = 'page-index.twig', array $templateVariables = []) {
        $templatePath = '/layouts/main.twig';
        if (isset($templatePath) ) {
        $template = $this->environment->load($templatePath);
        
        $templateVariables['content_template_name'] = $contentTemplateName;

        if (isset($_SESSION['auth']['user_name'])) {
            $templateVariables['user_authorized'] = true;
            $templateVariables['user_name'] = $_SESSION['auth']['user_name'];
            $templateVariables['user_lastname'] = $_SESSION['auth']['user_lastname'];
            $templateVariables['pageCounter'] = $_SESSION['pageCounter'];
            $templateVariables['title'] = 'имя страницы';
        }
        
        return $template->render($templateVariables);

        } else {
            throw new \Exception('Шаблон для загрузки страницы не найден');
        }
    }

    public static function renderExceptionPage(Exception $exception): string{
        $contentTemplateName = 'exception-template.twig';
        $viewFolder = '/src/Domain/Views/';

        $loader = new FilesystemLoader($_SERVER['DOCUMENT_ROOT'] . $viewFolder);
        $environment = new Environment($loader, [
            //'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);

        $template = $environment->load('/layouts/main.twig');

        $templateVariables['content_template_name'] = $contentTemplateName;
        $templateVariables['error_message'] = $exception->getMessage();
        $templateVariables['errorTitle'] = 'Произошла ошибка!';
        $templateVariables['title'] = 'ErrorPage';

        return $template->render($templateVariables);
    }

    public function renderPageWithForm(string $contentTemplateName = 'page-index.twig', array $templateVariables = []) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $templateVariables['csrf_token'] = $_SESSION['csrf_token'];  
        
        return $this->renderPage($contentTemplateName, $templateVariables);

    }
}