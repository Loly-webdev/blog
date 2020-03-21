<?php

namespace App\Controller;

use App\Entity\Comment;
use Core\DefaultAbstractController;
use App\Repository\CommentRepository;

class CommentController extends DefaultAbstractController
{
    public function indexAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('comment');

        if (isset($data)) {
            (new CommentRepository())->insert($data);
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

    public function insertAction()
    {
        // Retrieve all data in a table
        $data    = $this->getRequest()->getParam('comment');
        $message = '';

        if (isset($data)) {
            $comment = (new comment())->hydrate($data);
            $comment->hasId();
            $comment->setPost($_GET['articleId']);

            if ($comment->hasId() === false) {
                $commentRepository = (new CommentRepository());
                $inserted          = $commentRepository->insert($comment);
                $message           = $inserted
                    ? "Votre commentaire à bien était enregistré !"
                    : "Une erreur est survenue.";
            }
        }

        $this->renderView(
            'commentForm.html.twig',
            [
                'message' => $message
            ]
        );
    }

    public function deleteAction()
    {
        (new CommentRepository())->delete($this->getRequest()->getParam('commentId'));
        $this->renderView(
            'commentForm.html.twig',
            [
                'message' => "Votre commentaire à bien était supprimé !"
            ]
        );
    }

    public function updateAction()
    {
        // Retrieve all data in a table
        $commentId = $this->getRequest()->getParam('commentId');
        $comment   = (new CommentRepository())->find($commentId);
        //throw exception
        $data = $this->getRequest()->getParam('comment');
        $message = '';

        if (isset($data)) {
            echo 'hello';
            $comment = $comment->hydrate($data);
            if (array_key_exists('post', $data)) {
                unset($data['post']);
            }
            $updated = (new CommentRepository())->update($comment);
            $message = $updated
                ? "Votre commentaire à bien était modifié !"
                : "Une erreur est survenue.";
        }

        $this->renderView(
            'commentEdit.html.twig',
            [
                'comment' => $comment,
                'message' => $message
            ]
        );
    }
}
