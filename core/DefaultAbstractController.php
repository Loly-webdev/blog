<?php

namespace Core;

use Exception;

abstract class DefaultAbstractController implements DefaultControllerInterface
{
    protected        $request;

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
        $defaultPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR;
        $viewFolder  = $viewFolder ?? $this->getFolderView();
        $view        = (new TwigProvider())->getTwig()->render($viewFolder . $viewName, $params);

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
}
