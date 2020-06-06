<?php

namespace App\Controller;

use App\Repository\UserRepository;
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
        $this->renderView(
            'home.html.twig'
        );
    }

    public function welcomeAction()
    {
        $userId = $_SESSION['user'];
        $user   = (new UserRepository())->findOneById($userId);
        $code   = $user->getRole();

        if ($code === 'admin') {
            $viewTemplate = 'homeAdmin.html.twig';
        }
        if ($code === 'user') {
            $viewTemplate = 'homeAdmin.html.twig';
        }

        $status = $user->getRoleLabel($code);
        $login  = $user->getLogin();

        $this->renderView(
            $viewTemplate,
            [
                'message' => "Ravi de te revoir $status $login !" ?? ''
            ],
            'back/'
        );
    }
}
