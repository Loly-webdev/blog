<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Traits\Controller\CUDControllerTrait;
use App\Repository\{
    ArticleRepository,
    CommentRepository
};
use Exception;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends DefaultAbstractController
{
    protected $key;

    use CUDControllerTrait;

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
            'article.html.twig'
        ];
    }

    public function preRenderView(array $data): array
    {
        // Load comments associate to the articleId
        $entityAssociate            = (new CommentRepository())
            ->find(['post' => $this->getRequest()->getParam('articleId')]);
        $entityNameAssociate        = 'comments';
        $data[$entityNameAssociate] = $entityAssociate ?? null;

        return $data;
    }

    /**
     * Give params to addAction
     * @return array
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            'article',
            new Article(),
            new ArticleRepository(),
            'articleForm.html.twig'
        ];
    }

    /**
     * Give params to editAction
     * @return array
     * @throws Exception
     */
    public function getEditParam(): array
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
     * @throws Exception
     */
    public function getDeleteParam(): array
    {
        return [
            new ArticleRepository(),
            'articleId',
            'article',
            'articleForm.html.twig'
        ];
    }
}
