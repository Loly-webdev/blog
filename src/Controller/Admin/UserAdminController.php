<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Traits\Controller\CUDControllerTrait;
use Exception;

class UserAdminController extends DefaultAbstractController
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
        $this->renderView(
            'home.html.twig'
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
            'formAuthentication.html.twig'
        ];
    }

    /**
     * Give params to addAction
     * @return array
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            'user',
            new User(),
            new UserRepository(),
            'formRegister.html.twig'
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
        return [
            new UserRepository(),
            'userId',
            'utilisateur',
            'formRegister.html.twig',
        ];
    }
}
