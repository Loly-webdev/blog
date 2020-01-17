<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_MODEL . 'ArticleManager.php';

class BlogController extends DefaultController
{
    public function indexAction()
    {
        try {
            $posts = ArticleManager::findAll();

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
}
