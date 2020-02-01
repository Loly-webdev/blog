<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';

class ErrorController extends DefaultAbstractController
{
    public function indexAction()
    {
    }

    public function error($t)
    {
        $this->renderView(
            '../error.html.twig',
            [
                'message' => $t->getMessage(),
                'file' => $t->getFile(),
                'line' => $t->getLine()
            ]
        );
    }
}
