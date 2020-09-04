<?php

namespace App\Controller\Admin;

use App\Repository\CommentRepository;
use Core\DefaultAbstract\LoggedAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\DeleteControllerTrait;
use Core\Traits\Controller\EditControllerTrait;
use Exception;

/**
 * Class CommentAdminController
 * @package App\Controller\Admin
 */
class CommentAdminController extends LoggedAbstractController
{
    use EditControllerTrait,
        DeleteControllerTrait;

    public static $entityLabel = "commentaire";

    /**
     * Action by default
     * @return mixed|void
     * @throws CoreException
     */
    public function indexAction()
    {
        $data = [];

        if (method_exists($this, 'commentApproved')) {
            $data = $this->commentApproved($data);
        }

        $repository     = (new CommentRepository());
        $paginationPath = "/Admin/commentAdmin?page=";
        $data           = $this->pagination($repository, $data, $paginationPath);

        $this->renderView(
            'admin/comment/comments.html.twig',
            $data
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function commentApproved(array $data): array
    {
        $approved         = 'oui';
        $data['approved'] = $approved;

        return $data;
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
            'admin/comment/editComment.html.twig'
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
            'admin/message.html.twig'
        ];
    }
}
