<?php

namespace App\Controller\Admin;

use App\Controller\RegisterController;
use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Traits\Controller\CUDControllerTrait;
use Exception;

class UserAdminController extends LoggedAbstractController
{
    use CUDControllerTrait;

    /**
     * Action by default
     * Show form to connexion
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $userId = $_SESSION['id'];
        $user   = (new UserRepository())->findOneById($userId);
        assert($user instanceof User);
        $code   = $user->getRole();
        $status = $user->getRoleLabel($code);
        $login  = $user->getLogin();

        $this->renderView(
            'homeBack.html.twig',
            [
                'message' => "Ravi de te revoir $status $login !" ?? ''
            ]
        );
    }

    /**
     * Give params to seeAction
     * @return array
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'userId',
            'user',
            new UserRepository(),
            'profile.html.twig'
        ];
    }

    /**
     * Give params to edit Action
     * @return array
     * @throws Exception
     */
    public function getEditParam(): array
    {
        return [
            'userId',
            new UserRepository(),
            'user',
            'editProfile.html.twig'
        ];
    }

    /**
     * Give params to deleteAction
     * @return array
     * @throws Exception
     */
    public function getDeleteParam(): array
    {
        $register = new RegisterController();
        return [
            new UserRepository(),
            'userId',
            (new User())->getRoleLabel($register->role()),
            'formRegister.html.twig',
        ];
    }

    public function profileAction()
    {
        $userId = $_SESSION['id'];
        $user   = (new UserRepository())->findOneById($userId);

        $this->renderView(
            'profile.html.twig',
            [
                'user' => $user
            ]
        );
    }
}
