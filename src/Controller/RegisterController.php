<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        if($this->hasFormSubmitted('authentication')) {
            echo 'Votre formulaire à déjà été soumis';
        }

        $this->renderView(
            'register.html.twig'
        );
    }
}
