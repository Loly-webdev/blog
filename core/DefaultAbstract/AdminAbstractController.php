<?php

namespace Core\DefaultAbstract;

use Core\Exception\CoreException;

/**
 * Class AdminAbstractController
 * @package Core\DefaultAbstract
 */
class AdminAbstractController extends LoggedAbstractController
{
    protected $request;

    /**
     *  DefaultAbstractController
     */
    public function __construct()
    {
        parent::__construct();

        // Define the view directory
        if ('admin' === isset($_SESSION['role'])) {
            $this->redirectTo('home/logged');
        }
    }

    /**
     * Path to repository of views
     * @return string
     */
    public function getFolderView(): string
    {
        return 'back/admin';
    }
}
