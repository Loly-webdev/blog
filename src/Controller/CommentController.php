<?php

namespace App\Controller;

use App\Controller\FormValidator\FormCommentValidator;
use App\Entity\Comment;
use App\Entity\User;
use App\Repository\CommentRepository;
use App\Service\Email;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Core\Traits\Controller\SeeControllerTrait;
use Exception;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends LoggedAbstractController
{
    use SeeControllerTrait,
        AddControllerTrait;

    public static  $entityLabel = "commentaire";
    private static $key         = 'comment';

    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        $this->renderView(
            'formComment.html.twig'
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
            'commentId',
            'comment',
            new CommentRepository(),
            'comment/comments.html.twig'
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
    public function preRenderView(array $data): array
    {
        $user         = $this->getUserLogged();
        $data['user'] = $user;

        return $data;
    }

    /**
     * @param Comment $entity
     * @param array|null $formValues
     *
     * @return void
     * @throws CoreException
     */
    public function postHydrate(?array $formValues,Comment $entity): void
    {
        $entity->setArticleId(
            $this->getRequest()->getParamAsInt('articleId')
        );

        $user = $this->getUserLogged();
        assert($user instanceof User);
        $entity->setAuthor($user->getLogin());
    }

    /**
     * @return bool
     * @throws CoreException
     */
    public function mailApproved(): bool
    {
        $user = $this->getUserLogged();
        assert($user instanceof User);
        $nameUser = $user->getLogin();

        $subject = 'Nouveau commentaire à approuver';
        $message = '<br>Vous avez un nouveau commentaire à approuvé, de ' . $nameUser .
                   '<br> <a href="http://blog/Admin/userAdmin?_page=1">Voir les commentaires à approuver >></a>';

        return Email::sendMail($user->getMail(), $subject, $message);
    }
}
