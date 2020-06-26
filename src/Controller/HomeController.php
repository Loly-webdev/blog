<?php

namespace App\Controller;

use App\Entity\User;
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
        if (isset($_SESSION['logged']) === true) {
            $userId = $_SESSION['id'];

            $user   = (new UserRepository())->findOneById($userId);
            assert($user instanceof User);
            $code   = $user->getRole();

            if ($code === 'admin') {
                $viewTemplate = 'homeBack.html.twig';
            }
            if ($code === 'user') {
                $viewTemplate = 'homeBack.html.twig';
            }

            $status = $user->getRoleLabel($code);
            $login  = $user->getLogin();

            $this->renderView(
                $viewTemplate,
                [
                    'message' => "Ravi de te revoir $status $login !" ?? ''
                ]
            );
            exit();
        }
        $this->renderView(
            'home.html.twig',
            [
                'message' => "Bonjour et bienvenu sur mon site !"
            ]
        );
    }
}
