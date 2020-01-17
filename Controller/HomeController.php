<?php

require_once PROJECT_CORE . 'DefaultController.php';

class HomeController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'home.html.twig',
            ['']
        );
    }
}
