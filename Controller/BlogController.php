<?php

require PROJECT_ROOT . 'Core/DefaultController.php';
require PROJECT_ROOT . 'Repository/CommentManager.php';
require PROJECT_ROOT . 'Repository/PostManager.php';

class BlogController extends DefaultController
{
    public function indexAction()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        $this->renderView(
            PROJECT_ROOT . 'View/Front/listPostsView.php'
        );
    }

    function post()
    {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        $this->renderView(
            PROJECT_ROOT . 'View/Front/postView.php'
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