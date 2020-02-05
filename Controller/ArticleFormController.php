<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';

class ArticleFormController extends DefaultAbstractController
{
    public function indexAction()
    {
        $articles = (new ArticleRepository())->AddArticle();

        $this->renderView(
            'articleForm.html.twig',
            [
                'posts' => $articles
            ]
        );
    }
}
