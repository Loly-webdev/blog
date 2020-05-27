<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;
use Core\Provider\ConfigurationProvider;

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
     * @throws CoreException
     */
    public function loginAction(): void
    {
        $message = '';
        $page    = 'Article';

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
            session_destroy();

            if (password_verify($password . $salt, $passwordUser)) {
                $_SESSION['logged'] = true;
                $_SESSION['user']   = $user;

                header("Refresh: 3; URL= /" . $page);
                echo 'Veuillez patientez vous allez être redirigé.';
                exit();
            }
            else {
                $message = "Echec de l'authentification";
            }
        }

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'title'   => 'Connexion :',
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
        echo 'Veuillez patientez vous allez être redirigé.';
        exit();
    }
}
