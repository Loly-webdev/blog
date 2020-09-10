<?php

namespace App\Controller\Admin;

use App\Repository\CommentRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\DeleteControllerTrait;
use Core\Traits\Controller\EditControllerTrait;
use Exception;

/**
 * Class CommentAdminController
 * @package App\Controller\Admin
 */
class CommentAdminController extends LoggedAbstractController
{
    use EditControllerTrait,
        DeleteControllerTrait;

    public static $entityLabel = "commentaire";

    /**
     * Action by default
     * @return mixed|void
     * @throws CoreException
     */
    public function indexAction()
    {
        $viewData = [];

        $queryValues = (new CommentRepository())->search(['approved' => 'oui']);
        $viewData    = $this->pagination(
            $queryValues,
            $viewData,
            "/Admin/commentAdmin?_page=",
            'comments'
        );

        $this->renderView(
            'admin/comment/comments.html.twig',
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
            'commentId',
            new CommentRepository(),
            'comment',
            'admin/comment/editComment.html.twig'
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
            new CommentRepository(),
            'commentId',
            'admin/message.html.twig'
        ];
    }

    public function preDelete(array $viewData): array
    {
        $viewData['page'] = '/Admin/commentAdmin?_page=1';
        $viewData['namePage'] = 'Retour à la liste des commentaires';

        return $viewData;
    }
}
