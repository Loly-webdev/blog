<?php

namespace App\Controller;

use App\Entity\Comment;
use Core\DefaultAbstractController;
use App\Repository\CommentRepository;
use Core\Traits\DeleteControllerTrait;
use Core\Traits\InsertControllerTrait;
use Core\Traits\SeeControllerTrait;
use Core\Traits\UpdateControllerTrait;

class CommentController extends DefaultAbstractController
{
    use SeeControllerTrait;
    use InsertControllerTrait;
    use UpdateControllerTrait;
    use DeleteControllerTrait;

    public function indexAction()
    {
        return $this->seeAction();
    }

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

    public function getInsertParam(): array
    {
        return [
            'comment',
            new Comment(),
            new CommentRepository(),
            'commentForm.html.twig'
        ];
    }

    public function getUpdateParam(): array
    {
        return [
            'commentId',
            new CommentRepository(),
            'comment',
            'commentEdit.html.twig'
        ];
    }

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
