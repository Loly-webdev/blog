<?php

require_once PROJECT_CORE . 'DefaultController.php';

class HomeController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'Front/home.html.twig',
            ['test' => 'Hello World !!!']
        );
    }
}
