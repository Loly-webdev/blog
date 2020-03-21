<?php

namespace App\Controller;

use Core\DefaultAbstractController;

class ConnexionController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }
}
