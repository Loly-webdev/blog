<?php

require(PROJECT_ROOT . 'model/model.php');
require(PROJECT_ROOT . 'core/DefaultController.php');

class BlogController extends DefaultController
{
    public function indexAction()
    {
        $this->renderView(
            PROJECT_ROOT . 'view/frontend/listPostsView.php'
        );
    }

    public function post()
    {
        $this->renderView(
            PROJECT_ROOT . 'view/frontend/postView.php'
        );
    }

    public function addComment($postId, $author, $comment)
    {
        $affectedLines = postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
}
