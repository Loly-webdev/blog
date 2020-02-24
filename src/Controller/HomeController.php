<?php

namespace App\Controller;

use Core\DefaultAbstractController;

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
