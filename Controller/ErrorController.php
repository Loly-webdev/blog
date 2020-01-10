<?php

require_once PROJECT_CORE . 'DefaultController.php';

class ErrorController extends DefaultController
{
    public function indexAction()
    {
        // TODO: Implement indexAction() method.
    }

    public function error($t)
    {
        $this->renderView(
            'error.html.twig',
            [
                'message' => $t->getMessage(),
                'file' => $t->getFile(),
                'line' => $t->getLine()
            ]
        );
    }
}