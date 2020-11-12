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

    public static  $entityLabel = "article";
    private static $key         = 'article';

    /**
     * @return mixed|void
     * @throws CoreException
     */
    public function indexAction()
    {
        $viewData = [];

        $queryValues = (new ArticleRepository())->find();
        $viewData    = $this->pagination(
            $queryValues,
            $viewData,
            "/Admin/articleAdmin?_page=",
            'articles'
        );

        $this->renderView(
            'admin/article/articles.html.twig',
            $viewData
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
    public function preRenderView(array $data): array
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
            'admin/message.html.twig'
        ];
    }

    /**
     * @param array $viewData
     *
     * @return array
     */
    public function preDelete(array $viewData): array
    {
        $viewData['page']     = '/Admin/articleAdmin?_page=1';
        $viewData['namePage'] = 'Retour à la liste des articles';

        return $viewData;
    }
}
