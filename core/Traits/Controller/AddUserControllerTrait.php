<?php

namespace Core\Traits\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\utils\Helper;
use Core\Exception\CoreException;

trait AddUserControllerTrait
{
    use AddControllerTrait {
        AddControllerTrait::postSave as basePostSave;
    }

    private static $key = 'user';

    /**
     * @param      $formValues
     * @param User $entity
     *
     * @throws CoreException
     */
    public function postHydrate($formValues, User $entity): void
    {
        $entity->setRole($entity->role());
        $this->check($formValues, $entity);
    }

    /**
     * @param array|mixed[] $formValues
     * @param object        $entity
     */
    public function check(array $formValues, object $entity): void
    {
        $email    = $formValues['mail'] ?? '';
        $password = $formValues['password'] ?? '';

        $viewName = 'formRegister.html.twig';
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $viewName = 'admin/user/formUser.html.twig';
        }

        $this->checkUserExist($formValues, $viewName, $email);

        if (false === Helper::checkEmail($email)) {
            $message = "l'adresse $email n'est pas valide";
            $this->errorFlashMessage($message, $viewName);
        }

        if ($formValues['password'] !== $formValues['password2']) {
            $message = "Les mots de passe ne sont pas identique";
            $this->errorFlashMessage($message, $viewName);
        }

        $entity->setMail($email)
               ->setPassword($password);
    }

    /**
     * @param array  $formValues
     * @param string $viewName
     * @param string $email
     */
    public function checkUserExist(array $formValues, string $viewName, string $email): void
    {
        $user = new UserRepository();
        $login   = $formValues['login'] ?? '';
        $userByLogin = $user->search(['login'  => $login]);
        $userByMail = $user->search(['mail'  => $email]);

        if (!empty($userByLogin)) {
            $message = "Le login $login existe déjà ";
            $this->errorFlashMessage($message, $viewName);
        }
        if (!empty($userByMail)) {
            $message = "Un compte avec l'adresse $email existe déjà";
            $this->errorFlashMessage($message, $viewName);
        }
    }
}
