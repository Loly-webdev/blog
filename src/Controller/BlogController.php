<?php

namespace App\Controller;

use App\Repository\{ArticleRepository, CommentRepository};
use Core\DefaultAbstract\{DefaultAbstractController, DefaultAbstractEntity};
use Core\Traits\Controller\{SeeControllerTrait};
use Exception;

/**
 * Class BlogController
 * @package App\Controller
 */
class BlogController extends DefaultAbstractController
{
    use SeeControllerTrait;

    public static $entityLabel = "article";

    /**
     * Action by default
     * Show all articles
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();

        if ($this->isLogged()) {
            $this->redirectTo('article');
        }

        $this->renderView(
            '/article/articles.html.twig',
            [
                'articles' => $articles,
                'page'     => 'blog'
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
     * @param array|mixed[]         $data
     * @param DefaultAbstractEntity $entity
     *
     * @return array|mixed[]
     */
    public function preRenderView(array $data, DefaultAbstractEntity $entity): array
    {
        $comments         = (new CommentRepository())->search(
            [
                'approved' => 'oui',
                'articleId' => $entity->getId()
            ]
        );

        $data['comments'] = $comments;

        return $data;
    }
}
