<?php

namespace Core\DefaultAbstract;

use App\Service\SessionUserService;
use Core\DefaultControllerInterface;
use Core\Exception\CoreException;
use Core\Provider\TwigProvider;
use Core\Request;

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
     * @throws CoreException
     */
    public function getUserLogged(): ?DefaultAbstractEntity
    {
        // error 401
        if (false === $this->isLogged()) {
            throw new CoreException('Vous devez être authentifié pour accéder à cette page.');
        }

        $user = SessionUserService::getUserLogged();
        // error 403
        if (null === $user) {
            throw new CoreException('L\'utilisateur n\'est pas reconnu.');
        }

        return $user;
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
        return SessionUserService::hasLogged();
    }

}
