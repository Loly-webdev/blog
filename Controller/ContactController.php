<?php

require_once PROJECT_CORE . 'DefaultController.php';

class ContactController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            'contact.html.twig',
            ['test' => 'Hello World !!!']
        );
    }


}