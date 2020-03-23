<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstractController;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Core\Traits\DeleteControllerTrait;
use Core\Traits\InsertControllerTrait;
use Core\Traits\SeeControllerTrait;
use Core\Traits\UpdateControllerTrait;

class ArticleController extends DefaultAbstractController
{
    protected $key;

    use SeeControllerTrait;
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

    public function getSeeParam(): array
    {
        return [
            'articleId',
            'article',
            new ArticleRepository(),
            new CommentRepository(),
            'article.html.twig',
            'comments',
        ];
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
