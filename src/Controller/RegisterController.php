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
     * @return array|mixed[]
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

    /**
     * @return string
     */
    public function role(): string
    {
        if ((new User())->isAdmin()) {
            return User::ROLE_ADMIN;
        }
        return User::ROLE_USER;
    }

    /**
     * @param object $entity
     * @throws CoreException
     */
    public function postHydrate($entity): void
    {
        $formValidator = new FormRegisterValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {
            $formValues = $formValidator->getFormValues();
            $this->check($formValues);
        }
        $entity->setRole($this->role());
    }

    /**
     * @param array $formValues
     * @throws CoreException
     */
    public function check(array $formValues)
    {
        $email = $formValues['mail'] ?? '';

        if (false === Helper::checkEmail($email)) {
            throw new Exception("l'adresse $email n'est pas valide");
        }

        if ($formValues['password'] !== $formValues['password2']) {
            throw new CoreException("Les deux mot de passe ne sont pas identique");
        }

        (new User())->setMail($email)
            ->setPassword($formValues['password']);
    }
}
