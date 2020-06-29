<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\utils\Helper;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Exception;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    use AddControllerTrait;

    /**
     * Action by default
     */
    public function indexAction()
    {
        $this->addAction();
    }

    /**
     * Give params to addAction
     * @return array
     * @throws Exception
     */
    public function getAddParam(): array
    {
        return [
            (new User())->getRoleLabel($this->role()),
            'user',
            new User(),
            new UserRepository(),
            'formRegister.html.twig'
        ];
    }

    public function role()
    {
        if ((new User())->isAdmin() === true) {
            return $role = (new User())::ROLE_ADMIN;
        }
        return $role = (new User())::ROLE_USER;
    }

    public function postHydrate($entity): void
    {
        $this->check();
        $role = $this->role();

        $entity->setRole($role);
    }

    public function check()
    {
        $formValidator = new FormRegisterValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            $formValues = $formValidator->getFormValues();

            $email     = $formValues['mail'] ?? '';
            $password  = $formValues['password'] ?? '';
            $password2 = $formValues['password2'] ?? '';

            if (false === Helper::verifyAddress($email)) {
                throw new Exception("l'adresse $email n'est pas valide");
            }

            if ($password !== $password2) {
                throw new CoreException("Les deux mot de passe ne sont pas identique");
            }
            (new User())->setMail($email)
                        ->setPassword($password);
        }
    }
}
