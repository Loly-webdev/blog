<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultAbstractController implements DefaultControllerInterface
{
    private $request;
    private static $twig = null;

    public function getRequest()
    {
        return $this->request = Request::getInstance();
    }

    public static function getTwig()
    {
        if (null === self::$twig) {
            require_once PROJECT_VENDOR . 'autoload.php';
            $loader = new FilesystemLoader('View/');
            self::$twig = new Environment($loader,
                // le cache est utile en prod mais pas en dev,
                // le laisser  en false pour le dev
                // et indiquer le nom du dossier ('Cache') pour la prod
                [
                    'cache' => false
                ]
            );
        }
        return self::$twig;
    }

    public function renderView($view, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = PROJECT_VIEW;
        $viewFolder = $viewFolder ?? $this->getFolderView();

        if (file_exists($defaultPath . $viewFolder . $view)) {
            echo $this->getTwig()->render($viewFolder . $view, $params);
        }
    }

    public function getFolderView(): string
    {
        return 'template/front/';
    }
}
