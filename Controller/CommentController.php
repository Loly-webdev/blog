<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';

class CommentController extends DefaultAbstractController
{
    public function indexAction()
    {
    }

    public function addAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('comment');

        if (null === $data) {
            $this->renderView(
                'commentForm.html.twig'
            );
        }

        if (isset($data)) {
            (new CommentRepository())->addComment($data);
            $this->renderView(
                'commentForm.html.twig',
                [
                    'message' => "Votre commentaire à bien était ajouté !"
                ]
            );
        }
    }
}
