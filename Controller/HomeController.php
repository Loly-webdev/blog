<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';

class HomeController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->renderView(
            'home.html.twig'
        );
    }

    public function contactAction()
    {
        $this->renderView(
            'contact.html.twig'
        );
    }

    public function connexionAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }
}
