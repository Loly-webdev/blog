<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';

class CommentController extends DefaultAbstractController
{
    public function indexAction()
    {
        try {
            //$comments = CommentRepository::findArticleComments($_GET['id']);
            $comments = CommentRepository::findArticleComments(2);
            var_dump($comments);

            $this->renderView(
                'comment.html.twig',
                [
                    'comments' => $comments
                ]
            );

        } catch (Throwable $t) {

            require_once PROJECT_CONTROLLER . 'ErrorController.php';
            $error = new ErrorController();
            $error->error($t);
        }
    }
}
