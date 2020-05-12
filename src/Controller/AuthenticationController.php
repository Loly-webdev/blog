<?php

namespace App\Controller;

use App\Entity\User;
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

        if ($this->hasFormSubmitted('formAuthentication')) {
            $formData = $this->getFormSubmittedValues('formAuthentication');
            $login = $formData['login'] ?? '';
            $password = $formData['password'] ?? '';
            $passwordEncoded = User::encodePassword($password);

            $user = (new UserRepository())->findOne(
                [
                    'login' => $login,
                    'password' => $passwordEncoded
                ]
            );
            dump($user);

            if (null === $user) {
                $message = "Echec de l'authentification";
            }

            if ($user->hasId()) {
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $user;
            }
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

        /* //Si lutilisateur est connecte, on le deconecte
         if(isset($_SESSION['logged']))
         {
             //On le deconecte en supprimant la session
             unset($_SESSION['logged']);
         }*/

        header('location: index.php');
        exit();
    }
}
