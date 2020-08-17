<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\utils\Helper;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class AccountService
 * @package App\Service
 */
abstract class AccountService extends DefaultAbstractController
{
    /**
     * @param mixed $params
     *
     * @return DefaultAbstractEntity
     */
    public static function retrieveAccount($params): ?DefaultAbstractEntity
    {
        $login = $params['login'];

        $user = (new UserRepository())->findOne(['login' => $login]);

        // Check if $user is an instance of User class
        assert($user instanceof User);

        if (null === $user) {
            return null;
        }
        $accountIsValid = Helper::checkPassword($params['password'], $user->getPassword());

        return $accountIsValid ? $user : null;
    }

}
