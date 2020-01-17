<?php

require_once PROJECT_MODEL . 'DefaultManager.php';

/**
 * This class make the sql request common tot the different Entitymanagers.
 * All of the EntityManagers have to extend this class
 */
abstract class Manager extends DefaultManager
{
    // default constant of the database table name
    protected static $tableName;

    /**
     * This function find all the informations contained in the table
     * @throws Exception
     */
    public static function findAll()
    {
        $req = static::getPDO()->query('
            SELECT *
            FROM ' . static::$tableName . '
            ORDER BY creation_date DESC
        ');

        $req->execute();

        return $req->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $id [id of the element]
     * @return mixed
     * @throws Exception
     */
    public static function findOneById($id)
    {
        $req = static::getPDO()->prepare('
            SELECT *
            FROM ' . static::$tableName . '
            WHERE id = ?
            ');

        $req->execute(array($id));

        return $req->fetch();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $id [id of the element]
     * @return bool
     * @throws Exception
     */
    public static function deleteById($id)
    {
        $req = static::getPDO()->prepare('
            DELETE
            FROM ' . static::$tableName . '
            WHERE id = ?
            ');

        return $req->execute(array($id));
    }
}
