<?php

namespace App\Controller;

use App\Repository\{ArticleRepository, CommentRepository};
use Core\DefaultAbstract\{DefaultAbstractEntity, LoggedAbstractController};
use Core\Exception\CoreException;
use Core\Traits\Controller\SeeControllerTrait;
use Exception;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends LoggedAbstractController
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

        $this->renderView(
            '/article/articles.html.twig',
            [
                'articles' => $articles,
                'page'     => 'article'
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
        // Load comments associate to the articleId
        $comments         = (new CommentRepository())->search(
            [
            'approved' => 'oui',
            'articleId' => $entity->getId()
            ]
        );

        $data['comments'] = $comments;

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws CoreException
     */
    public function prePost(array $data): array
    {
        $user         = $this->getUserLogged();
        $data['user'] = $user;

        return $data;
    }
}
