<?php

namespace App\Controller;

use Core\DefaultAbstractController;
use App\Repository\CommentRepository;

class CommentController extends DefaultAbstractController
{
    public function indexAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('comment');

        if (isset($data)) {
            (new CommentRepository())->add($data);
            $lastId = (new CommentRepository())->getPDO()->lastInsertId();

            header("Location: /comment/add?commentId=$lastId");
        }
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
        $comment = (new CommentRepository())->find($commentId);

        if (null === $comment) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
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

    public function addAction()
    {
        $commentId = $this->getRequest()->getParam('commentId');

        // Load last comment post
        $comment = (new CommentRepository())->find($commentId);

        $this->renderView(
            'comment.html.twig',
            [
                'comment' => $comment,
                'message' => "Votre commentaire à bien était ajouté !"
            ]
        );
    }

    public function deleteAction()
    {
        (new CommentRepository())->delete($this->getRequest()->getParam('commentId'));
    }

    public function updateAction()
    {
        // todo
    }
}
