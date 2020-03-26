<?php

namespace App\Controller;

use Core\DefaultAbstractController;
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
        $this->renderView(
            'connexion.html.twig'
        );
    }
}
