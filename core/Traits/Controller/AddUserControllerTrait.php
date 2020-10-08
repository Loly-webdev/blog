<?php

namespace Core\Traits\Controller;

use App\Entity\User;
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

        if (false === Helper::checkEmail($email)) {
            $message = "l'adresse $email n'est pas valide";
            $this->errorMessage($message);

            exit();
        }

        if ($formValues['password'] !== $formValues['password2']) {
            $message = "Les mots de passe ne sont pas identique";
            $this->errorMessage($message);

            exit();
        }

        $entity->setMail($email)
               ->setPassword($password);
    }

    public function errorMessage(string $message): ?array
    {
        $viewData = [
            'status'        => 'danger',
            'statusMessage' => $message,
            'page'          => '/Admin/userAdmin/userList?_page=1',
            'namePage'      => 'Retour à la liste des membres'
        ];

        return $this->renderView(
            'admin/message.html.twig',
            $viewData
        );
    }
}
