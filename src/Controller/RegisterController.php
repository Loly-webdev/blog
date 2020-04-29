<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }
}
