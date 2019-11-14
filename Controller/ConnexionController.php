<?php

require PROJECT_ROOT . 'Core/DefaultController.php';

class ConnexionController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'View/Front/connexionView.php'
        );
    }
}