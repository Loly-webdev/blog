<?php

namespace App\Controller;

use App\Entity\User;
use Core\DefaultAbstract\DefaultAbstractController;
use App\Repository\UserRepository;
use Core\Traits\Controller\{
    AddControllerTrait,
    EditControllerTrait,
    DeleteControllerTrait
};
use Exception;

/**
 * Class ConnexionController
 * @package App\Controller
 */
class ConnexionController extends DefaultAbstractController
{
    use AddControllerTrait,
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
        $this->renderView(
            'connexion.html.twig'
        );
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

    public function getConnexion()
    {

    }
}
