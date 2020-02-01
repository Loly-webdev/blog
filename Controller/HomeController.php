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
}
