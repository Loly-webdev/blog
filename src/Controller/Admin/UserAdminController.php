<?php

namespace App\Controller\Admin;

use App\Controller\FormValidator\FormRegisterValidator;
use App\Controller\RegisterController;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Core\Traits\Controller\DeleteControllerTrait;
use Core\Traits\Controller\EditControllerTrait;
use Exception;

/**
 * Class UserAdminController
 * @package App\Controller\Admin
 */
class UserAdminController extends LoggedAbstractController
{
    use AddControllerTrait,
        EditControllerTrait,
        DeleteControllerTrait;

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

        $login    = $user->getLogin();
        $comments = (new CommentRepository())->find();

        $data = [
            'message'  => "Ravi de te revoir $status $login !",
            'comments' => $comments
        ];

        if (method_exists($this, 'commentApproved')) {
            $data = $this->commentApproved($data);
        }

        $this->renderView(
            'admin/dashboard.html.twig',
            $data
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function commentApproved(array $data): array
    {
        $approved         = 'non';
        $data['approved'] = $approved;

        return $data;
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
            'admin/user/editUser.html.twig'
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
            'admin/user/formUser.html.twig',
        ];
    }

    /**
     * @return void
     * @throws CoreException
     */
    public function userListAction(): void
    {
        $users = (new UserRepository())->find();

        $this->renderView(
            'admin/user/users.html.twig',
            [
                'users' => $users
            ]
        );
    }

    /**
     * @return array
     */
    public function getAddParam(): array
    {
        return [
            new FormRegisterValidator(),
            new User(),
            new UserRepository(),
            'admin/user/formUser.html.twig'
        ];
    }
}
