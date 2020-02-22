<?php

class UserRepository
{
    static $tableName = 'user';

    public function add($data)
    {
        $sql = $this->getPDO()->prepare('
           INSERT INTO ' . static::$tableName . '
           (login, pass)
           VALUES (:login, :pass)');

        $sql->execute($data);
    }

    public function connect()
    {

    }

}
