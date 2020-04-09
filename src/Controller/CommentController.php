<?php

namespace App\Controller;

use App\Entity\Comment;
use Core\DefaultAbstract\DefaultAbstractController;
use App\Repository\CommentRepository;
use Core\Traits\Controller\{
    SeeControllerTrait,
    AddControllerTrait,
    EditControllerTrait,
    DeleteControllerTrait
};
use Exception;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends DefaultAbstractController
{
    use SeeControllerTrait,
        AddControllerTrait,
        EditControllerTrait,
        DeleteControllerTrait;

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

    public function entityIdAssociate(): int
    {
        return $_GET['articleId'];
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
        return $entityClass->setPost($_GET['articleId']);
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

    public function keyExist($data)
    {
        unset($data['post']);
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
