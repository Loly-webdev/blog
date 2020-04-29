<?php

namespace Core\DefaultAbstract;

use Core\DefaultControllerInterface;
use Core\Provider\TwigProvider;
use Core\Request;
use Core\Exception\CoreException;
use LogicException;

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


    public function hasFormSubmitted(string $formName): bool
    {
        $data = $this->getRequest()->getParam($formName);

        return isset($data);
    }


    public function getFormSubmittedValues($formName): array
    {
        $data = $this->getRequest()->getParam($formName);

        if (false === is_array($data)) {
            throw new LogicException('Un formulaire doit être passer en tableau.');
        }

        return $data;
    }

    /**
     * Method to see the views of the site
     *
     * @param string      $viewName
     * @param array       $params
     * @param string|null $viewFolder
     *
     * @throws CoreException
     */
    public function renderView($viewName, array $params = [], string $viewFolder = null): void
    {
        $defaultPath = VIEW_ROOT;
        $viewFolder  = $viewFolder ?? $this->getFolderView();
        $view        = (new TwigProvider())->getTwig()
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
        // Define the view directory
        return 'front/';
    }

    public function redirect($page)
    {
        return header("Refresh: 5; URL= /" . $page);
    }
}
