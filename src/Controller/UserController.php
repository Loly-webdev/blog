<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Exception;

class UserController extends LoggedAbstractController
{
    /**
     * Action by default
     * Show form to connexion
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $user = $this->getUserLogged();
        assert($user instanceof User);
        $login = $user->getLogin();

        $this->renderView(
            'homeBack.html.twig',
            [
                'message' => "Ravi de te revoir $login !"
            ]
        );
    }

    /**
     * Give params to seeAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'userId',
            'user',
            new UserRepository(),
            'user/user.html.twig'
        ];
    }

    /**
     * @return void
     * @throws CoreException
     */
    public function profileAction(): void
    {
        $this->renderView(
            'user/user.html.twig',
            [
                'user' => $this->getUserLogged()
            ]
        );
    }
}
