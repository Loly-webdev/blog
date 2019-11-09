<?php

require(PROJECT_ROOT . 'core/DefaultController.php');

class HomeController extends DefaultController
{
    public function indexAction()
    {
        echo 'HomeController';
    }

    public function home()
    {
        $this->renderView(
            '/view/frontend/postView.php'
        );
    }
}