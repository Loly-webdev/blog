<?php

require (PROJECT_ROOT . 'core/DefaultController.php');
require (PROJECT_ROOT . 'model/CommentManager.php');
require (PROJECT_ROOT . 'model/PostManager.php');

class BlogController extends DefaultController
{
    public function indexAction()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        $this->renderView(
            PROJECT_ROOT . 'view/frontend/listPostsView.php'
        );
    }

    function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        $this->renderView(
            PROJECT_ROOT . 'view/frontend/postView.php'
        );
    }

    function addComment($postId, $author, $comment)
    {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: blog?action=post&id=' . $postId);
        }
    }
}