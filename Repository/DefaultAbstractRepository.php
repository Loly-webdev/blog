<?php

require_once PROJECT_CORE . 'DefaultPDO.php';
require_once PROJECT_REPOSITORY . 'DefaultRepositoryInterface.php';

abstract class DefaultAbstractRepository extends DefaultPDO implements DefaultRepositoryInterface
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DefaultPDO::PDOConnect();
    }

    /**
     * This method make the connection to the database and load the Request class
     * @throws Exception
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * This function find all the informations contained in the table
     * @throws Exception
     */
    public function find()
    {
        $req = $this->getPDO()->query('
            SELECT *
            FROM ' . static::getTableData()['name'] . '
            ORDER BY ' . static::getTableData()['pk'] . ' DESC
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
    public function findOne($articleId)
    {
        $req = $this->getPDO()->prepare('
            SELECT *
            FROM ' . static::getTableData()['name'] . '
            WHERE ' . static::getTableData()['pk'] . ' = ?
            ');

        $req->execute(array($articleId));

        return $req->fetch();
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
