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
    static function encodePassword(string $plainText)
    {
        $config       = ConfigurationProvider::getInstance();
        $salt         = $config->getSalt();
        $pwd_peppered = hash_hmac("sha256", $plainText, $salt);

        return password_hash($pwd_peppered, PASSWORD_ARGON2ID);
    }

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
        $page = 'Blog';

        if ($this->hasFormSubmitted('formAuthentication')) {
            $formData = $this->getFormSubmittedValues('formAuthentication');
            $login    = $formData['login'] ?? '';
            $password = $formData['password'] ?? '';
            $passwordEncoded = static::encodePassword($password);

            $user = (new UserRepository())->findOne(
                [
                    'login'    => $login,
                    'password' => $password
                ]
            );

            if (null === $user) {
                $message = "Echec de l'authentification";
            }

            /*if ($user->getRole() === 'admin') {
                $page = 'Admin/Home';
            }*/

            if (null !== $user) {
                $_SESSION['logged'] = true;
                $_SESSION['user']   = $user;

                header("Refresh: 3; URL= /" . $page);
                echo 'Veuillez patientez vous allez être redirigé.';
                exit();
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
        //header('location: /Home');
        echo 'Veuillez patientez vous allez être redirigé.';
        exit();
    }
}
