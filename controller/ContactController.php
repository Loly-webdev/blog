<?php

require(PROJECT_ROOT . 'core/DefaultController.php');

class ContactController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'view/frontend/contactView.php'
        );
    }


}