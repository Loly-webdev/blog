<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\AccountService;
use Core\DefaultAbstract\DefaultAbstractController;
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

            if (null !== $user = AccountService::retrieveAccount($formValidator->getFormValues())) {
                assert($user instanceof User);
                $this->addUserInSession($user);

                // Redirect to userAdminController
                $this->redirectTo('Admin/userAdmin');
            }

            $status = "danger";
            $message = "Echec de l'authentification";
        }

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'status' => $status ?? '',
                'message' => $message ?? ''
            ]
        );
    }

    /**
     * @param User $user
     * @return void
     */
    private function addUserInSession(User $user): void
    {
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $user->getId();
    }

    /**
     * User logout
     * @return void
     */
    public function logoutAction(): void
    {
        session_unset();
        session_destroy();

        $this->redirectTo('home');
    }
}
