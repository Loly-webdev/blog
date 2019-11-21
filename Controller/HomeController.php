<?php

require_once PROJECT_CORE . 'DefaultController.php';

class HomeController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_VIEW . 'Front/homeView.php'
        );
    }

    public function home()
    {
        $this->renderView(
            PROJECT_VIEW. 'Front/homeView.php'
        );
    }
}