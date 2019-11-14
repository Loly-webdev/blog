<?php

require PROJECT_ROOT . 'Core/DefaultController.php';

class HomeController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'View/Front/homeView.php'
        );
    }

    public function home()
    {
        $this->renderView(
            PROJECT_ROOT . 'view/frontend/homeView.php'
        );
    }
}