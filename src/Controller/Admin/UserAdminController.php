<?php

namespace App\Controller\Admin;

use App\Controller\RegisterController;
use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\CUDControllerTrait;
use Exception;

/**
 * Class UserAdminController
 * @package App\Controller\Admin
 */
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
        if (null === $this->getUserLogged()) {
            throw new CoreException('Vous n\'etes pas authentifié.');
        }

        $user = $this->getUserLogged();
        assert($user instanceof User);
        $status = $user->getRoleLabel();
        $login = $user->getLogin();

        $this->renderView(
            'homeBack.html.twig',
            [
                'message' => "Ravi de te revoir $status $login !"
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
            'profile/profile.html.twig'
        ];
    }

    /**
     * Give params to edit Action
     * @return array|mixed[]
     * @throws Exception
     */
    public function getEditParam(): array
    {
        return [
            'userId',
            new UserRepository(),
            'user',
            'profil',
            'profile/editProfile.html.twig'
        ];
    }

    /**
     * Give params to deleteAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getDeleteParam(): array
    {
        new RegisterController();
        return [
            new UserRepository(),
            'userId',
            (new User())->getRoleLabel(),
            'formRegister.html.twig',
        ];
    }

    /**
     * @return void
     * @throws CoreException
     */
    public function profileAction()
    {
        $userId = $_SESSION['id'];
        $user = (new UserRepository())->findOneById($userId);

        $this->renderView(
            'profile/profile.html.twig',
            [
                'user' => $user
            ]
        );
    }
}
