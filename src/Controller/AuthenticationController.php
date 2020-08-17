<?php

namespace App\Controller;

use App\Controller\FormValidator\FormAuthenticationValidator;
use App\Entity\User;
use App\Service\AccountService;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Session;
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
        $formValidator = new FormAuthenticationValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            if (null !== $user = AccountService::retrieveAccount($formValidator->getFormValues())) {
                assert($user instanceof User);
                $this->addUserInSession($user);

                // Redirect to userAdminController
                $this->redirectTo('Admin/userAdmin');
            }

            $status  = "danger";
            $message = "Echec de l'authentification";
        }

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'status'        => $status ?? '',
                'statusMessage' => $message ?? ''
            ]
        );
    }

    /**
     * @param User $user
     *
     * @return void
     */
    private function addUserInSession(User $user): void
    {
        Session::setValue('logged', true);
        Session::setValue('id', $user->getId());
    }

    /**
     * User logout
     * @return void
     */
    public function logoutAction(): void
    {
        Session::destroy();
        $this->redirectTo('home');
    }
}
