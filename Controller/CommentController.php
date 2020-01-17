<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_MODEL . 'CommentManager.php';

class CommentController extends DefaultController
{
    const ADD_COMMENT_SUCCESS = "Votre commentaire a bien été ajouté";
    const FAIL = 'Nous n\'avons pas pu ajouté votre commentaire, veuillez rééssayer ultérieurement';

    public function indexAction()
    {
        try {
            $posts = CommentManager::findComments($id);

            $this->renderView(
                'listPosts.html.twig',
                [
                    'posts' => $posts
                ]
            );

        } catch (Throwable $t) {

            require_once PROJECT_CONTROLLER . 'ErrorController.php';
            $error = new ErrorController();
            $error->error($t);
        }
    }


    /**
     * function to add a comment on the display article
     * Display the article page
     * @throws Exception
     */
    public
    static function add()
    {
        $request = Request::getInstance();
        $postId = $request->getParam('id');
        $comment = $request->getParam('comment');
        $add = CommentManager::add($postId, $comment);
        if ($add == true) {
            $message = static::ADD_COMMENT_SUCCESS;
            $alert = 'success';
        } else {
            $message = static::FAIL;
            $alert = 'danger';
        }

        $postController = new ArticleController();
        $postController->post($alert, $message);
    }

    /**
     * function to report a comment
     * @throws Exception
     */
    public
    static function report()
    {
        $request = Request::getInstance();
        $commentId = $request->getParam('id');
        $postNumber = $request->getParam('post');
        CommentManager::report($commentId);
        header("Location: /post/post?post=$postNumber#commentForm");
    }


}
