<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    /**
     * Action by default
     */
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }
}
