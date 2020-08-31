<?php

namespace App\Controller\Admin;

use App\Controller\FormValidator\FormArticleValidator;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Core\Traits\Controller\DeleteControllerTrait;
use Core\Traits\Controller\EditControllerTrait;
use Exception;

class ArticleAdminController extends LoggedAbstractController
{
    use AddControllerTrait,
        EditControllerTrait,
        DeleteControllerTrait;

    public static $entityLabel = "article";

    /**
     * @return mixed|void
     * @throws CoreException
     */
    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();

        $this->renderView(
            'admin/article/articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    /**
     * Give params to addAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            new FormArticleValidator(),
            new Article(),
            new ArticleRepository(),
            'admin/article/formArticle.html.twig'
        ];
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
            'admin/article/editArticle.html.twig'
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
            'admin/article/articles.html.twig'
        ];
    }
}
