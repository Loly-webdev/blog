<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstractController;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Core\Traits\DeleteControllerTrait;
use Core\Traits\InsertControllerTrait;
use Core\Traits\UpdateControllerTrait;

class ArticleController extends DefaultAbstractController
{
    protected $key;

    use InsertControllerTrait;
    use UpdateControllerTrait;
    use DeleteControllerTrait;

    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();
        //pour des listes déroulante
        //$article = (new ArticleRepository())->selectColumns(['title', 'content']);

        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles
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
        $article = (new ArticleRepository())->findOne($articleId);

        if (null === $article) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException(
                sprintf('Désolé, nous n\'avons pas trouvé l\'article avec l\'id: %d', $articleId)
            );
        }

        // Load comments associate to the articleId
        $comments = (new CommentRepository())->find(['post' => $articleId]);

        $this->renderView(
            'article.html.twig',
            [
                'article'  => $article,
                'comments' => $comments
            ]
        );
    }

    public function getInsertParam(): array
    {
        return [
            'article',
            new Article(),
            new ArticleRepository(),
            'articleForm.html.twig'
        ];
    }

    public function getUpdateParam(): array
    {
        return [
            'articleId',
            new ArticleRepository(),
            'article',
            'articleEdit.html.twig'
        ];
    }

    public function getDeleteParam(): array
    {
        return [
            new ArticleRepository(),
            'articleId',
            'articleForm.html.twig',
            'Votre article à bien était supprimé !'
        ];
    }
}
