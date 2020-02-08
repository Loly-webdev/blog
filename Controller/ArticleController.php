<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';


class ArticleController extends DefaultAbstractController
{
    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();

        $this->renderView(
            'articles.html.twig',
            [
                'posts' => $articles
            ]
        );
    }

    public function seeAction()
    {
        // Get id to the URL
        $articleId = $this->getRequest()->getParam('articleId');

        if (null === $articleId) {
            throw new \InvalidArgumentException(
                'Désolé, mais la valeur de l\'article n\'est pas renseignée.'
            );
        }

        // Load article associate to the articleId or return null
        $article = (new ArticleRepository())->find($articleId);

        if (null === $article) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException(
                sprintf('Désolé, nous n\'avons pas trouvé l\'article avec l\'id: %d', $articleId)
            );
        }

        // Load comments associate to the articleId
        $comments = (new CommentRepository())->findByArticleId($articleId);

        $this->renderView(
            'article.html.twig',
            [
                'article' => $article,
                'comments' => $comments
            ]
        );
    }

    public function articleFormAction()
    {
        $articles = (new ArticleRepository())->AddArticle();

        $this->renderView(
            'articleForm.html.twig',
            [
                'posts' => $articles
            ]
        );
    }

    public function commentFormAction()
    {
        $comments = (new CommentRepository())->AddComment();

        $this->renderView(
            'commentForm.html.twig',
            [
                'comments' => $comments
            ]
        );
    }
}
