<?php

require_once PROJECT_CORE . 'DefaultController.php';

class ConnexionController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_VIEW . 'Front/connexionView.php'
        );
    }
}