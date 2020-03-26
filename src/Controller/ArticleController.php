<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstractController;
use App\Repository\{
    ArticleRepository,
    CommentRepository
};
use Core\Traits\{
    DeleteControllerTrait,
    InsertControllerTrait,
    SeeControllerTrait,
    UpdateControllerTrait
};
use Exception;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends DefaultAbstractController
{
    protected $key;

    use SeeControllerTrait,
        InsertControllerTrait,
        UpdateControllerTrait,
        DeleteControllerTrait;

    /**
     * Action by default
     * Show all articles
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();
        // For drop-down lists
        // $article = (new ArticleRepository())->selectColumns(['title', 'content']);

        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    /**
     * Give params to seeAction
     * @return array
     * @throws Exception
     */
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

    /**
     * Give params to insertAction
     * @return array
     * @throws Exception
     */
    public function getInsertParam(): array
    {
        return [
            'article',
            new Article(),
            new ArticleRepository(),
            'articleForm.html.twig'
        ];
    }

    /**
     * Give params to update Action
     * @return array
     * @throws Exception
     */
    public function getUpdateParam(): array
    {
        return [
            'articleId',
            new ArticleRepository(),
            'article',
            'articleEdit.html.twig'
        ];
    }

    /**
     * Give params to deleteAction
     * @return array
     * @throws \Exception
     */
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
