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
     * @var string
     */
    static $entityLabel = "profil";

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
            'formRegister.html.twig',
        ];
    }

    /**
     * @return void
     * @throws CoreException
     */
    public function profileAction()
    {
        $this->renderView(
            'profile/profile.html.twig',
            [
                'user' => $this->getUserLogged()
            ]
        );
    }
}
