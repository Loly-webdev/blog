<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Traits\Controller\{blogControllerTrait, SeeControllerTrait};
use Exception;

/**
 * Class BlogController
 * @package App\Controller
 */
class BlogController extends DefaultAbstractController
{
    use SeeControllerTrait,
        blogControllerTrait;

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
}
