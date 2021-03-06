<?php

namespace Core\DefaultAbstract;

use App\Service\SessionUserService;
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
     * @return bool
     */
    public function isLogged(): bool
    {
        return SessionUserService::hasLogged();
    }

    /**
     * redirect method
     *
     * @param string $route
     */
    public function redirectTo(string $route): void
    {
        header('Location: /' . $route);
        exit();
    }

    /**
     * @param array  $queryValues
     * @param array  $data
     * @param string $paginationPath
     * @param string $entityName
     *
     * @return array
     */
    public function pagination(
        array $queryValues,
        array $data,
        string $paginationPath,
        string $entityName
    ): array
    {
        $nbEntity = count($queryValues);
        $perPage  = 3;
        $nbPage   = ceil($nbEntity / $perPage);
        $cPage    = Request::getInstance()->getParamAsInt('_page') ?? 1;

        $entities = array_slice($queryValues, ($cPage - 1) * $perPage, $perPage);

        $data[$entityName]      = $entities;
        $data['lastPage']       = $nbPage;
        $data['currentPage']    = $cPage;
        $data['paginationPath'] = $paginationPath;

        return $data;
    }

    /**
     * @param string $message
     * @param string $viewName
     *
     * @return array|null
     * @throws CoreException
     */
    public function errorFlashMessage(
        string $message,
        string $viewName
    ): ?array
    {
        $viewData = [
            'status'        => 'danger',
            'statusMessage' => $message
        ];

        $this->renderView(
            $viewName,
            $viewData
        );
        exit();
    }

    /**
     * Method to see the views of the site
     *
     * @param string      $viewName
     * @param array       $params
     * @param string|null $viewFolder
     *
     * @return void
     * @throws CoreException
     */
    public function renderView(
        string $viewName,
        array $params = [],
        string $viewFolder = null
    ): void
    {
        $defaultPath = VIEW_ROOT;
        $viewFolder  = $viewFolder ?? $this->getFolderView();
        $view        = TwigProvider::getTwig()
                                   ->render($viewFolder . $viewName, $params + ['session' => Session::getData()]);

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
}
