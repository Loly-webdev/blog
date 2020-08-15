<?php

namespace App\Service;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Session;

/**
 * Class SessionUserService
 * @package App\Service
 */
final class SessionUserService
{
    /**
     * @return bool
     */
    public static function hasLogged(): bool
    {
        return Session::getValue('logged', false);
    }

    /**
     * @return DefaultAbstractEntity|null
     */
    public static function getUserLogged(): ?DefaultAbstractEntity
    {
        $userId = Session::getValue('id');

        if (null === $userId) {
            return null;
        }

        return (new userRepository())->findOneById($userId);
    }
}
