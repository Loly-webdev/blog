<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Traits\Controller\CUDControllerTrait;
use Exception;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends DefaultAbstractController
{
    use CUDControllerTrait;

    /**
     * Action by default
     * Show an comment
     * @return mixed|void
     */
    public function indexAction()
    {
        $this->seeAction();
    }

    /**
     * Give params to seeAction
     * @return array
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'commentId',
            'comment',
            new CommentRepository(),
            'comment.html.twig'
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
            'comment',
            new Comment(),
            new CommentRepository(),
            'commentForm.html.twig'
        ];
    }

    public function dependencyId($entityClass)
    {
        return $entityClass->setArticleId($_GET['articleId']);
    }

    /**
     * Give params to edit Action
     * @return array
     * @throws Exception
     */
    public function getEditParam(): array
    {
        return [
            'commentId',
            new CommentRepository(),
            'comment',
            'commentEdit.html.twig'
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
            new CommentRepository(),
            'commentId',
            'commentaire',
            'commentForm.html.twig'
        ];
    }
}
