<?php

namespace App\Controller\Admin;

use App\Controller\RegisterController;
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\SeeControllerTrait;
use Exception;

/**
 * Class UserAdminController
 * @package App\Controller\Admin
 */
class UserAdminController extends LoggedAbstractController
{
    use SeeControllerTrait;

    /**
     * @var string
     */
    public static $entityLabel = "profil";

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

        if ($status !== 'Administrateur') {
            $this->redirectTo('home');
        }

        $login = $user->getLogin();
        $articles = (new ArticleRepository())->find();

        $this->renderView(
            'admin/dashboard.html.twig',
            [
                'message' => "Ravi de te revoir $status $login !",
                'articles' => $articles
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
    public function profileAction(): void
    {
        $this->renderView(
            'profile/profile.html.twig',
            [
                'user' => $this->getUserLogged()
            ]
        );
    }
}
