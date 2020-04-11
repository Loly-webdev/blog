<?php

namespace App\Repository;

use App\Entity\User;
use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Class UserRepository
 * @package App\Repository
 * Make the database requests relative to the users
 */
class UserRepository extends DefaultAbstractRepository
{
    static $tableName = 'user';

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return User::class;
    }
}
