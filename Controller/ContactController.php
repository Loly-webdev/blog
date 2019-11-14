<?php

require PROJECT_ROOT . 'Core/DefaultController.php';

class ContactController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'View/Front/contactView.php'
        );
    }


}