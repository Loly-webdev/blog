<?php

require(PROJECT_ROOT . 'core/DefaultController.php');

class ConnexionController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'view/frontend/connexionView.php'
        );
    }
}