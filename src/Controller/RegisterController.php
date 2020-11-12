<?php

namespace App\Controller;

use App\Controller\FormValidator\FormRegisterValidator;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Email;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;
use Core\Traits\Controller\AddControllerTrait;
use Core\Traits\Controller\AddUserControllerTrait;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    use AddUserControllerTrait,
        AddControllerTrait {
        AddControllerTrait::postSave as basePostSave;
    }

    public static $entityLabel = "inscription";

    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        $this->renderView(
            'formRegister.html.twig'
        );
    }

    /**
     * @param mixed $saved
     * @param User  $entity
     */
    public function postSave($saved, User $entity): void
    {
        $this->basePostSave($saved, $entity);
    }

    /**
     * @param User $entity
     *
     * @return bool
     */
    public function mailInfo(User $entity): bool
    {
        $nameUser = $entity->getLogin();

        $subject = 'Confirmation d\'inscription';
        $message = '<br>Bienvenue à toi ' . $entity->getRoleLabel() . ' ' . $nameUser . ' !
                    <br> Je te confirme ton inscription à mon blog, en esperant qu\'il sera à ton goût 
                    <br>Pour toutes questions ou soucis que tu pourrais rencontrer, n\'hésite pas à me le signaler via le formulaire de contact.
                    <br><a href="http://blog/">Aller sur le blog >></a>';

        return Email::infoMail($entity->getMail(), $subject, $message);
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
}
