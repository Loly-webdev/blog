<?php

namespace Core\DefaultAbstract;

class LoggedAbstractController extends DefaultAbstractController
{
    /**
     * DefaultAbstractController constructor
     */
    public function __construct()
    {
        parent::__construct();

        // Define the view directory
        if (false === isset($_SESSION['logged'])) {
            $this->redirectTo('authentication');
        }
    }

    public function indexAction()
    {
        $this->renderView(
            'formAuthentication.html.twig'
        );
    }

    public function getFolderView(): string
    {
        return 'back/';
    }
}
