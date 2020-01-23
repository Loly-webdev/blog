<?php

require_once PROJECT_CORE . 'DefaultPDO.php';
require_once PROJECT_REPOSITORY . 'DefaultRepositoryInterface.php';

abstract class DefaultAbstractRepository extends DefaultPDO implements DefaultRepositoryInterface
{
    /**
     * This method make the connection to the database and load the Request class
     * @throws Exception
     */
    public static function getPDO()
    {
        return DefaultPDO::PDOConnect();
    }

    /**
     * This function find all the informations contained in the table
     * @throws Exception
     */
    public static function find()
    {
        $req = static::getPDO()->query('
            SELECT *
            FROM ' . static::getTableData()['name'] . '
            ORDER BY ' . static::getTableData()['order'] . ' DESC
        ');

        $req->execute();

        return $req->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $articleId
     * @return mixed
     * @throws Exception
     */

    public static function findOne($articleId)
    {
        $req = static::getPDO()->prepare('
            SELECT *
            FROM ' . static::getTableData()['name'] . '
            WHERE ' . static::getTableData()['pk'] . ' = ?
            ');

        $req->execute(array($articleId));

        return $req->fetch();
    }

    /**
     * This function find all comments in an article
     * @param $articleId
     * @return array
     * @throws Exception
     */
    public static function findByArticleId($articleId)
    {
        $req = static::getPDO()->prepare('
            SELECT * 
            FROM ' . static::getTableData()['name'] . ' 
            WHERE ' . static::getTableData()['pk'] . ' = ?
            ORDER BY ' . static::getTableData()['order'] . ' DESC 
        ');
        $req->execute(array($articleId));

        return $req->fetchAll();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $id
     * @return bool
     * @throws Exception
     */
    public static function deleteById($id)
    {
        $req = static::getPDO()->prepare('
            DELETE
            FROM ' . static::getTableData()['name'] . '
            WHERE ' . static::getTableData()['pk'] . ' = ?
            ');

        return $req->execute(array($id));
    }
}
