<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_REPOSITORY. 'CommentManager.php';
require_once PROJECT_REPOSITORY . 'PostManager.php';

class PostController extends DefaultController
{
    public function indexAction()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        $this->renderView(
            PROJECT_VIEW . 'Front/listPostsView.php',
            [
                'posts' => $posts
            ]
        );
    }

    function post($postManager)
    {
        $post = $postManager->getPost($_GET['id']);
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($_GET['id']);

        $this->renderView(
            PROJECT_VIEW . 'Front/postView.php',
            [
                'post' => $post,
                'comments'=> $comments
            ]
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
            header('Location: /post/id=' . $postId);
        }
    }
}