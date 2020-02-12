<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';


class ArticleController extends DefaultAbstractController
{
    protected $key;

    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();
        $article = (new ArticleRepository())->selectColumns(['title', 'content']);
        //var_dump($article);


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
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('article');

        if (null === $data) {
            $this->renderView(
                'articleForm.html.twig'
            );
        }

        if (isset($data)) {
            (new ArticleRepository())->AddArticle($data);

            $this->renderView(
                'articleForm.html.twig',
                [
                    'message' => "Votre article à bien était enregistré !"
                ]
            );
        }
    }

    public function commentFormAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('comment');

        if (null === $data) {
            $this->renderView(
                'commentForm.html.twig'
            );
        }

        if (isset($data)) {
            (new CommentRepository())->AddComment($data);
            $this->renderView(
                'commentForm.html.twig',
                [
                    'message' => "Votre commentaire à bien était ajouté !"
                ]
            );
        }
    }
}
