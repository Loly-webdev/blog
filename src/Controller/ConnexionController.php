<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;
use Core\HTTPRequest;
use Core\Request;
use Core\User;
use Exception;

/**
 * Class ConnexionController
 * @package App\Controller
 */
class ConnexionController extends DefaultAbstractController
{
    /**
     * Action by default
     * Show form to connexion
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $request = Request::getInstance();
        $this->renderView(
            'connexion.html.twig'
        );

        $login    = $request->getParam('login');
        $password = $request->getParam('password');

        if (isset($login) && isset($password)) {
            (new User())->setAuthenticated(true);
        }
        else {
            throw new Exception('Le pseudo ou le mot de passe est incorrect.');
        }
    }
}
