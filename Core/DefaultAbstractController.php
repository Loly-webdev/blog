<?php

namespace Core;

use Exception;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class DefaultAbstractController implements DefaultControllerInterface
{
    protected static $twig;
    protected $request;

    public function __construct()
    {
	    $this->request = Request::getInstance();
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function renderView($viewName, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'template'. DIRECTORY_SEPARATOR;
        $viewFolder = $viewFolder ?? $this->getFolderView();
        $view = $this->getTwig()->render($viewFolder . $viewName, $params);

        //check if the view exist or return of exception
        if (false === file_exists($defaultPath . $viewFolder . $viewName)) {
            throw new Exception("La vue $defaultPath . $viewFolder . $viewName n'existe pas.");
        }

        echo $view;
    }

    public function getFolderView(): string
    {
        // Define the view directory
        return 'front/';
    }

    public static function getTwig()
    {
        // instance of Twig
        if (null === static::$twig) {
            $loader = new FilesystemLoader('template/');
            static::$twig = new Environment($loader,
                // To the prod define the path of directory Cache, else to dev keep false
                [
                    'cache' => false,
                    'debug' => DEBUG_TWIG
                ]
            );
        }
        if (DEBUG_TWIG) {
            static::$twig->addExtension(new DebugExtension());
        }

        return static::$twig;
    }
}
