<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstract\DefaultAbstractController;
use App\Repository\{
    ArticleRepository,
    CommentRepository
};
use Core\Request;
use Core\Traits\Controller\{
    SeeControllerTrait,
    AddControllerTrait,
    EditControllerTrait,
    DeleteControllerTrait
};
use Exception;

// On démarre la session AVANT d'écrire du code HTML
session_start();

$request = Request::getInstance();
$login    = $request->getParam('login');
$password = $request->getParam('password');

$_SESSION['login'] = $login;
$_SESSION['password'] = $password;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends DefaultAbstractController
{
    protected $key;

    use SeeControllerTrait,
        AddControllerTrait,
        EditControllerTrait,
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
