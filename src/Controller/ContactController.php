<?php

namespace App\Controller;

use Core\DefaultAbstractController;

class ContactController extends DefaultAbstractController
{
    public function indexAction()
    {
        $this->renderView(
            'contact.html.twig'
        );
    }
}
