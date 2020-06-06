<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;
use Core\Provider\ConfigurationProvider;
use Exception;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends DefaultAbstractController
{
    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        $this->renderView(
            'formAuthentication.html.twig'
        );
    }

    /**
     * User login
     * @throws Exception
     */
    public function loginAction(): void
    {
        if ($this->hasFormSubmitted('formAuthentication')) {
            $formData = $this->getFormSubmittedValues('formAuthentication');
            $login    = $formData['login'] ?? '';
            $password = $formData['password'] ?? '';
            $salt     = ConfigurationProvider::getInstance()->getSalt();

            $user = (new UserRepository())->findOne(
                [
                    'login' => $login
                ]
            );

            $passwordUser = $user->getPassword();

            if (session_id()) {
                session_unset();
            }

            if (password_verify($password . $salt, $passwordUser)) {
                $_SESSION['logged'] = true;
                $_SESSION['user']   = $user->getId();
                $code               = $user->getRole();

                if ($code === 'admin') {
                    $page = '/home/welcome';
                    header('Location: ' . $page);
                    exit();
                }
                if ($code === 'user') {
                    $page = '/home/welcome';
                    header('Location: ' . $page);
                    exit();
                }
            }
            $message = "Echec de l'authentification";
        }
        $this->renderView(
            'formAuthentication.html.twig',
            [
                'message' => $message ?? ''
            ]
        );
    }

    /**
     * User logout
     */
    public function logoutAction()
    {
        session_unset();
        session_destroy();

        header("Refresh: 3; URL= /Home");
        echo 'Veuillez patientez vous allez être redirigé vers l\'accueil.';
        exit();
    }
}
