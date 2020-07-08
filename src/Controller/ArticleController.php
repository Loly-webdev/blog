<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\{ArticleRepository, CommentRepository};
use Core\DefaultAbstract\{DefaultAbstractEntity, LoggedAbstractController};
use Core\Traits\Controller\{AddControllerTrait, CUDControllerTrait};
use Exception;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends LoggedAbstractController
{
    use CUDControllerTrait,
        AddControllerTrait;

    /**
     * Action by default
     * Show all articles
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();

        $this->renderView(
            '/article/articles.html.twig',
            [
                'title' => 'Derniers billets du blog :',
                'articles' => $articles
            ]
        );
    }

    /**
     * Give params to seeAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'articleId',
            'article',
            new ArticleRepository(),
            'article/articleById.html.twig',
        ];
    }

    /**
     * @param array|mixed[] $data
     * @param DefaultAbstractEntity $entity
     * @return array|mixed[]
     */
    public function preRenderView(array $data, DefaultAbstractEntity $entity): array
    {
        // Load comments associate to the articleId
        $comments = (new CommentRepository())->find(['articleId' => $entity->getId()]);
        $data['comments'] = $comments;

        return $data;
    }

    /**
     * Give params to addAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            'article',
            'article',
            new Article(),
            new ArticleRepository(),
            'article/formArticle.html.twig'
        ];
    }

    /**
     * Give params to editAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getEditParam(): array
    {
        return [
            'articleId',
            new ArticleRepository(),
            'article',
            'article/editArticle.html.twig'
        ];
    }

    /**
     * Give params to deleteAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getDeleteParam(): array
    {
        return [
            new ArticleRepository(),
            'articleId',
            'article',
            'article/formArticle.html.twig'
        ];
    }
}
