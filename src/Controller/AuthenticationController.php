<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\DefaultAbstract\DefaultAbstractEntity;
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
     * @throws Exception
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
        $formValidator = new FormAuthenticationValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            if (null !== $user = $this->retrieveAccount($formValidator->getFormValues())) {
                assert($user instanceof User);
                $this->addUserInSession($user);

                $status  = "success";
                $message = "Authentification réussi";

                //si role = admin, on redirige vers l'accueil de l'admin sinon vers celui de l'user
                //$this->redirectTo($user->isAdmin() ? 'home' : 'home');
                $this->redirectTo('home');

            }

            $status  = "danger";
            $message = "Echec de l'authentification";
        }

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'status'  => $status ?? '',
                'message' => $message ?? ''
            ]
        );
    }

    /**
     * @param mixed $params
     *
     * @return DefaultAbstractEntity
     */
    private function retrieveAccount($params): ?DefaultAbstractEntity
    {
        $login    = $params['login'];
        $password = $params['password'];

        $user = (new UserRepository())->findOne(['login' => $login]);

        // On vérifie que $user est bien une instance de classe User
        assert($user instanceof User);

        if (null === $user) {
            return null;
        }

        $accountIsValid = $this->checkPassword($password, $user->getPassword());

        return $accountIsValid ? $user : null;
    }

    private function checkPassword(string $password, string $passwordUser): bool
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_verify($password . $salt, $passwordUser);
    }

    private function addUserInSession(User $user)
    {
        $_SESSION['logged'] = true;
        $_SESSION['user']   = $user;
        $_SESSION['id'] = $user->getId();
    }

    /**
     * User logout
     */
    public function logoutAction()
    {
        session_unset();
        session_destroy();

        $this->redirectTo('home');
    }
}
