<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Traits\Controller\{
    SeeControllerTrait,
    AddControllerTrait,
    EditControllerTrait,
    DeleteControllerTrait
};
use Exception;

class UserController extends DefaultAbstractController
{
    use SeeControllerTrait,
        AddControllerTrait,
        EditControllerTrait,
        DeleteControllerTrait;

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
     * Give params to seeAction
     * @return array
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'id',
            'user',
            new UserRepository(),
            null,
            'connexion.html.twig',
            null
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
            'connexionForm.html.twig'
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
            'id',
            new UserRepository(),
            'user',
            'connexionEdit.html.twig'
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
            'id',
            'login',
            'connexionForm.html.twig',
        ];
    }
    public function profile()
    {

    }
}

{

}
