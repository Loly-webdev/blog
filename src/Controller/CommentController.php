<?php

namespace App\Controller;

use App\Entity\Comment;
use Core\DefaultAbstractController;
use App\Repository\CommentRepository;
use Core\Traits\{
    DeleteControllerTrait,
    InsertControllerTrait,
    SeeControllerTrait,
    UpdateControllerTrait
};
use Exception;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends DefaultAbstractController
{
    use SeeControllerTrait,
        InsertControllerTrait,
        UpdateControllerTrait,
        DeleteControllerTrait;

    /**
     * Action by default
     * Show an comment
     * @return mixed|void
     */
    public function indexAction()
    {
        return $this->seeAction();
    }

    /**
     * Give params to seeAction
     * @return array
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'commentId',
            'comment',
            new CommentRepository(),
            null,
            'comment.html.twig',
            null
        ];
    }

    /**
     * Give params to insertAction
     * @return array
     * @throws Exception
     */
    public function getInsertParam(): array
    {
        return [
            'comment',
            new Comment(),
            new CommentRepository(),
            'commentForm.html.twig'
        ];
    }

    /**
     * Give params to update Action
     * @return array
     * @throws Exception
     */
    public function getUpdateParam(): array
    {
        return [
            'commentId',
            new CommentRepository(),
            'comment',
            'commentEdit.html.twig'
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
            new CommentRepository(),
            'commentId',
            'commentForm.html.twig',
            'Votre commentaire à bien était supprimé !'
        ];
    }
}
