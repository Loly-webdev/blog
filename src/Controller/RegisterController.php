<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
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
        $role = $this->role();

        $entity->setRole($role);
    }
}
