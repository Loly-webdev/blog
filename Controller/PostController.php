<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_MANAGER. 'CommentManager.php';
require_once PROJECT_MANAGER . 'PostManager.php';

class PostController extends DefaultController
{
    public function indexAction()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        $this->renderView(
            'Front/listPosts.html.twig',
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
            'Front/post.html.twig',
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
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: /post/id=' . $postId);
        }
    }
}