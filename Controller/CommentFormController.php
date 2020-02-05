<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';

class CommentFormController extends DefaultAbstractController
{
    public function indexAction()
    {
        $comments = (new CommentRepository())->AddComment();

        $this->renderView(
            'commentForm.html.twig',
            [
                'comments' => $comments
            ]
        );
    }
}
