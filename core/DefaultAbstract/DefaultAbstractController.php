<?php

namespace Core\DefaultAbstract;

use Core\DefaultControllerInterface;
use Core\Provider\TwigProvider;
use Core\Request;
use Exception;

/**
 * Class DefaultAbstractController
 * @package Core
 */
abstract class DefaultAbstractController implements DefaultControllerInterface
{

    protected $request;

    /**
     * DefaultAbstractController constructor.
     */
    public function __construct()
    {
        $this->request = Request::getInstance();
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Method to see the views of the site
     *
     * @param string      $viewName
     * @param array       $params
     * @param string|null $viewFolder
     *
     * @throws Exception
     */
    public function renderView($viewName, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = '/var/www/blog/template/';
        $viewFolder  = $viewFolder ?? $this->getFolderView();
        $view        = (new TwigProvider())->getTwig()
                                           ->render($viewFolder . $viewName, $params);

        //check if the view exist or return of exception
        if (false === file_exists($defaultPath . $viewFolder . $viewName)) {
            throw new Exception("La vue $defaultPath . $viewFolder . $viewName n'existe pas.");
        }

        echo $view;
    }

    /**
     * Path to repository of views
     * @return string
     */
    public function getFolderView(): string
    {
        // Define the view directory
        return 'front/';
    }
}
