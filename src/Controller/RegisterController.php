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

    static $entityLabel = "inscription";

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
            new FormRegisterValidator(),
            new User(),
            new UserRepository(),
            'formRegister.html.twig'
        ];
    }

    /**
     * @param User $entity
     * @throws CoreException
     */
    public function postHydrate($entity): void
    {
        $formValidator = new FormRegisterValidator();
        if ($formValidator->isSubmitted() && $formValidator->isValid()) {
            $formValues = $formValidator->getFormValues();
            $entity->setRole($entity->role());
            $this->check($formValues, $entity);
        }
    }

    /**
     * @param array|mixed[] $formValues
     * @param object $entity
     * @throws CoreException
     */
    public function check(array $formValues, $entity): void
    {
        $email = $formValues['mail'] ?? '';
        $password = $formValues['password'] ?? '';

        if (false === Helper::checkEmail($email)) {
            throw new Exception("l'adresse $email n'est pas valide");
        }

        if ($formValues['password'] !== $formValues['password2']) {
            throw new CoreException("Les deux mot de passe ne sont pas identique");
        }

        $entity->setMail($email)
            ->setPassword($password);
    }
}
