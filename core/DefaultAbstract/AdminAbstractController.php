<?php

namespace Core\DefaultAbstract;

use Core\Exception\CoreException;

/**
 * Class AdminAbstractController
 * @package Core\DefaultAbstract
 */
abstract class AdminAbstractController extends LoggedAbstractController
{
    protected $request;

    /**
     *  DefaultAbstractController
     * @throws CoreException
     */
    public function __construct()
    {
        parent::__construct();

        // Define the view directory
        if ('admin' === $_SESSION['role']) {
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
