<?php

namespace App\Repository;

use App\Entity\User;
use Core\DefaultAbstract\DefaultAbstractRepository;

class UserRepository extends DefaultAbstractRepository
{
    static $tableName = 'users';

    /**
     * @inheritDoc
     */
    public function getEntity(): string
    {
        return User::class;
    }
}
