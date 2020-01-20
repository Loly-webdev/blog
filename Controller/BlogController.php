<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';

class BlogController extends DefaultAbstractController
{
    public function indexAction()
    {
        try {
            $posts = ArticleRepository::findAll();

            $this->renderView(
                'blog.html.twig',
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
}
