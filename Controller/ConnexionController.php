<?php

require_once PROJECT_CORE . 'DefaultController.php';

class ConnexionController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig',
            ['test' => 'Hello World !!!']
        );
    }
}