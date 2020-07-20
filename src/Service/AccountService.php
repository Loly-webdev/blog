<?php

namespace App\Service;

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

        if (empty($user)) {
            return null;
        }
        $accountIsValid = Helper::checkPassword($params['password'], $user->getPassword());

        return $accountIsValid ? $user : null;
    }
}
