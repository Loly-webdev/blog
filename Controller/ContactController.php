<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';

class ContactController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->renderView(
            'contact.html.twig'
        );
    }
}