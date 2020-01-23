<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';

class ConnexionController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }
}