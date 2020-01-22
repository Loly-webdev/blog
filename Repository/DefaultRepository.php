<?php

require_once PROJECT_CORE . 'DefaultPDO.php';
require_once PROJECT_REPOSITORY . 'DefaultRepositoryInterface.php';

abstract class DefaultRepository extends DefaultPDO implements DefaultRepositoryInterface
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
    public static function findAll()
    {
        $req = static::getPDO()->query('
            SELECT *
            FROM ' . static::getTableName() . '
            ORDER BY ' . static::getOrderBy() . ' DESC
        ');

        $req->execute();

        return $req->fetchAll();
    }

    /**
     * This function find all comments in an article
     * @param $articleId
     * @return array
     * @throws Exception
     */
    public static function findArticleComments($articleId)
    {
        $req = static::getPDO()->prepare('
            SELECT * 
            FROM ' . static::getTableName() . ' 
            WHERE ' . static::getTablePk() . ' = ?
            ORDER BY ' . static::getOrderBy() . ' DESC 
        ');
        $req->execute(array($articleId));

        return $req->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $articleId
     * @return mixed
     * @throws Exception
     */

    public static function findById($articleId)
    {
        $req = static::getPDO()->prepare('
            SELECT *
            FROM ' . static::getTableName() . '
            WHERE ' . static::getTablePk() . ' = ?
            ');

        $req->execute(array($articleId));

        return $req->fetch();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $articleId [id of the element]
     * @return bool
     * @throws Exception
     */
    public static function deleteById($articleId)
    {
        $req = static::getPDO()->prepare('
            DELETE
            FROM ' . static::getTableName() . '
            WHERE ' . static::getTablePk() . ' = ?
            ');

        return $req->execute(array($articleId));
    }
}
