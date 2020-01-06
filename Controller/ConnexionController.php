<?php

require_once PROJECT_CORE . 'DefaultController.php';

class ConnexionController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'Front/connexion.html.twig',
            ['test' => 'Hello World !!!']
        );
    }
}