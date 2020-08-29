<?php

namespace Core\DefaultAbstract;

use Core\Exception\CoreException;

abstract class LoggedAbstractController extends DefaultAbstractController
{
    /**
     * DefaultAbstractController constructor
     * @throws CoreException
     */
    public function __construct()
    {
        parent::__construct();

        // Define the view directory
        if (false === $this->isLogged()) {
            $this->redirectTo('authentication');
        }

        if (false === $this->getUserLogged()) {
            throw new CoreException('Votre utilisateur n\'est pas reconnu.');
        }
    }

    /**
     * @return string
     */
    public function getFolderView(): string
    {
        return 'back/';
    }
}
