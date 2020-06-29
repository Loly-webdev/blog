<?php

namespace App\Controller;

use Core\DefaultAbstract\DefaultAbstractController;
use Exception;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends DefaultAbstractController
{
    /**
     * Action by default
     * Show Home page
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        if (isset($_SESSION['logged']) === true) {
            $this->redirectTo('Admin/userAdmin');
        }

        $this->renderView(
            'home.html.twig',
            [
                'message' => "Bonjour et bienvenu sur mon site !"
            ]
        );
    }
}
