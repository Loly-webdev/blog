<?php

namespace App\Controller;

use App\Controller\FormValidator\FormCommentValidator;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Core\Traits\Controller\CUDControllerTrait;
use Exception;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends LoggedAbstractController
{
    use CUDControllerTrait,
        AddControllerTrait;

    public static $entityLabel = "commentaire";

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
     * @return array|mixed[]
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'commentId',
            'comment',
            new CommentRepository(),
            'comment/comment.html.twig'
        ];
    }

    /**
     * Give params to addAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            new FormCommentValidator(),
            new Comment(),
            new CommentRepository(),
            'comment/formComment.html.twig'
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
     * @param Comment $entity
     *
     * @return void
     */
    public function postHydrate($entity): void
    {
        $entity->setArticleId(
            $this->getRequest()->getParamAsInt('articleId')
        );
    }

    /**
     * Give params to edit Action
     * @return array|mixed[]
     * @throws Exception
     */
    public function getEditParam(): array
    {
        return [
            'commentId',
            new CommentRepository(),
            'comment',
            'comment/editComment.html.twig'
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
            new CommentRepository(),
            'commentId',
            'comment/formComment.html.twig'
        ];
    }
}
