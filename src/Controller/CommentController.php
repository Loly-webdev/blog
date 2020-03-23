<?php

namespace App\Controller;

use App\Entity\Comment;
use Core\DefaultAbstractController;
use App\Repository\CommentRepository;
use Core\Traits\DeleteControllerTrait;
use Core\Traits\InsertControllerTrait;
use Core\Traits\UpdateControllerTrait;

class CommentController extends DefaultAbstractController
{
    use InsertControllerTrait;
    use UpdateControllerTrait;
    use DeleteControllerTrait;

    public function indexAction()
    {
        return $this->seeAction();
    }

    public function seeAction()
    {
        // Get id to the URL
        $commentId = $this->getRequest()->getParam('commentId');

        if (null === $commentId) {
            throw new \InvalidArgumentException(
                'Désolé, mais la valeur de l\'article n\'est pas renseignée.'
            );
        }

        // Load article associate to the articleId or return null
        $comment = (new CommentRepository())->findOne($commentId);

        if (null === $comment) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            $articleId = $_GET['articleId'];
            throw new \LogicException(
                sprintf('Désolé, nous n\'avons pas trouvé l\'article avec l\'id: %d', $articleId)
            );
        }

        $this->renderView(
            'comment.html.twig',
            [
                'comment' => $comment
            ]
        );
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
