<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends DefaultAbstractController
{
    /**
     * Action by default
     */
    public function indexAction()
    {

    }

    /**
     * User login
     */
    public function login()
    {

    }

    /**
     * User logout
     */
    public function logout()
    {
        // On détruit les variables de notre session
        session_unset();

        // On détruit notre session
        session_destroy();

        // On redirige le visiteur vers la page d'accueil
        header('location: index.php');

    }
}
