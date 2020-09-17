<?php

namespace App\Controller\Admin;

use App\Controller\FormValidator\FormRegisterValidator;
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
    public static  $entityLabel = "utilisateur";
    private static $key         = 'user';

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
        $viewData = [
            'message' => "Ravi de te revoir $status $login !"
        ];

        $queryValues = (new CommentRepository())->search(['approved' => 'non']);
        $viewData    = $this->pagination(
            $queryValues,
            $viewData,
            "/Admin/userAdmin?_page=",
            'comments'
        );

        $this->renderView(
            'admin/dashboard.html.twig',
            $viewData
        );
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
        return [
            new UserRepository(),
            'userId',
            'admin/message.html.twig'
        ];
    }

    public function preDelete(array $viewData): array
    {
        $viewData['page']     = '/Admin/userAdmin/userList?_page=1';
        $viewData['namePage'] = 'Retour à la liste des membres';

        return $viewData;
    }

    /**
     * @return void
     * @throws CoreException
     */
    public function userListAction(): void
    {
        $viewData = [];

        $queryValues = (new UserRepository())->find();
        $viewData    = $this->pagination(
            $queryValues,
            $viewData,
            "/Admin/userAdmin/userList?_page=",
            'users'
        );

        $this->renderView(
            'admin/user/users.html.twig',
            $viewData
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
