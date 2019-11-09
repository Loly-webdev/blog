<?php

require(PROJECT_ROOT . 'model/model.php');
require(PROJECT_ROOT . 'core/DefaultController.php');

class BlogController extends DefaultController
{
    public function indexAction()
    {
       echo "BlogController";
    }

    public function blog()
    {
        $this->renderView(
            '/view/frontend/postView.php'
        );
    }

    /*
    function listPosts()
    {
        $posts = getPosts();

        require('view/frontend/listPostsView.php');
    }

    function post()
    {
        $post = getPost($_GET['id']);
        $comments = getComments($_GET['id']);

        require('view/frontend/postView.php');
    }

    function addComment($postId, $author, $comment)
    {
        $affectedLines = postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }*/
}
