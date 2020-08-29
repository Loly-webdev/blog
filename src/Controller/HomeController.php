<?php

namespace App\Controller;

use App\Entity\User;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;

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
     * @throws CoreException
     */
    public function indexAction()
    {
        if ($this->isLogged()) {
            $user = $this->getUserLogged();
            assert($user instanceof User);
            $this->redirectTo('user');
        }

        $this->renderView(
            'home.html.twig',
            [
                'message' => "Bonjour et bienvenu sur mon site !"
            ]
        );
    }
}
