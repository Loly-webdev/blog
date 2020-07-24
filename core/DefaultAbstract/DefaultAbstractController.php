<?php

namespace Core\DefaultAbstract;

use Core\DefaultControllerInterface;
use Core\Exception\CoreException;
use Core\Provider\TwigProvider;
use Core\Request;
use Core\Session;

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
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @return DefaultAbstractEntity|null
     */
    public function getUserLogged(): ?DefaultAbstractEntity
    {
        return Session::getUserLogged();
    }

    /**
     * Method to see the views of the site
     *
     * @param string $viewName
     * @param array $params
     * @param string|null $viewFolder
     *
     * @throws CoreException
     */
    public function renderView($viewName, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = VIEW_ROOT;
        $viewFolder = $viewFolder ?? $this->getFolderView();
        $view = (new TwigProvider())->getTwig()
            ->render($viewFolder . $viewName, $params);

        //check if the view exist or return of exception
        if (false === file_exists($defaultPath . $viewFolder . $viewName)) {
            throw new CoreException("La vue $defaultPath . $viewFolder . $viewName n'existe pas.");
        }
        echo $view;
    }

    /**
     * Path to repository of views
     * @return string
     */
    public function getFolderView(): string
    {
        return 'front/';
    }

    /**
     * redirect method
     *
     * @param string $route
     */
    public function redirectTo(string $route)
    {
        header('Location: /' . $route);
        exit();
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        return Session::getValue('logged', false);
    }

}
