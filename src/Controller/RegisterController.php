<?php

namespace App\Controller;

use App\Controller\Admin\UserAdminController;
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
            'formRegister.html.twig'
        );
    }

    public function addAction()
    {
        $user = (new UserAdminController());
        $user->addAction();
    }
}
