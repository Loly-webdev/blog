<?php

namespace App\Controller;

use App\Controller\FormValidator\FormAuthenticationValidator;
use App\Entity\User;
use App\Service\AccountService;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;
use Core\Session;
use Exception;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends DefaultAbstractController
{
    public static $key = 'formAuthentication';

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
     * @throws CoreException
     * @throws Exception
     */
    public function loginAction(): void
    {
        $formValidator = new FormAuthenticationValidator();
        $token         = Session::generateToken(static::$key);
        $status  = "danger";
        $message = "Echec de l'authentification.\n";

        if ($formValidator->isSubmitted() && $formValidator->isValid(static::$key)) {

            //dump(AccountService::retrieveAccount($formValidator->getFormValues()));
            if (null !== $user = AccountService::retrieveAccount($formValidator->getFormValues())) {
                assert($user instanceof User);
                $this->addUserInSession($user);

                // Redirect to userAdminController
                $this->redirectTo('user');
            }
        }
        $errors = implode(" ", $formValidator->getErrors()) . "\n";

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'status'        => $status ?? '',
                'statusMessage' => $message ?? '',
                'tokenValue'    => $token,
                'errors'        => $errors ?? ''
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
        Session::setValue('role', $user->getRole());
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
