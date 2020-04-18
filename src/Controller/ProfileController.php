<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Exception;

class ProfileController extends DefaultAbstractController
{
    /**
     * Action by default
     * Show form to connexion
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $profile = (new UserRepository())->find();

        $this->renderView(
            'profile.html.twig',
            [
                'profile' =>$profile
            ]
        );
    }

    /**
     * Displays the user profile
     */
    public function profile()
    {

    }
}
