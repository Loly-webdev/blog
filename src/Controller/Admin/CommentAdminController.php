<?php

namespace App\Controller\Admin;

use App\Repository\CommentRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\DeleteControllerTrait;
use Core\Traits\Controller\EditControllerTrait;
use Exception;

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
        $comments = (new CommentRepository())->find();

        $this->renderView(
            'admin/comment/comments.html.twig',
            [
                'comments' => $comments
            ]
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
            'admin/comment/comments.html.twig'
        ];
    }
}
