<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;

/**
 * Class ConnexionController
 * @package App\Controller
 */
class ConnexionController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->logIn();
    }

    public function logIn()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }

    public function logOut()
    {

    }
}
