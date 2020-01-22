<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';

class BlogController extends DefaultAbstractController
{
    public function indexAction()
    {
        $posts = ArticleRepository::findAll();

        $this->renderView(
            'blog.html.twig',
            [
                'posts' => $posts
            ]
        );
    }
}
