<?php

require_once PROJECT_CORE . 'DefaultPDO.php';

abstract class DefaultAbstractRepository extends DefaultPDO
{
    private $pdo;

    final public function __construct()
    {
        $this->pdo = DefaultPDO::PDOConnect();
        if (!isset(static::$tableName)) {
            throw new Exception('vous devez déclarez le nom de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tablePk)) {
            throw new Exception('vous devez déclarez la clé primaire de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tableOrder)) {
            throw new Exception('vous devez déclarez l\'ordre de tri de la table pour la classe ' . __CLASS__);
        }
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
            FROM ' . static::$tableName . '
            WHERE ' . static::$tablePk . ' = ?
            ');

        return $req->execute(array($id));
    }

    /**
     * This method make the connection to the database and load the Request class
     * @throws Exception
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    public function find($filters = null)
    {
        if (is_numeric($filters)) {
            return $this->findOne($filters);
        } elseif (!empty($filters)) {
            return $this->search($filters);
        }

        return $this->findAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $articleId
     * @return mixed
     * @throws Exception
     */
    public function findOne(int $articleId)
    {
        $req = $this->getPDO()->prepare('
            SELECT *
            FROM ' . static::$tableName . '
            WHERE ' . static::$tablePk . ' = ?
            ');

        $req->execute(array($articleId));

        return $req->fetch();
    }

    public function search(array $filters)
    {
        $sql = $this->getPDO()->prepare('
        SELECT *
        FROM ' . static::$tableName . '
        WHERE 1 = 1
        ');

        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        return $sql->execute(array_values($filters));
    }

    /**
     * This function find all the informations contained in the table
     * @return
     * @throws Exception
     */
    public function findAll()
    {
        $req = $this->getPDO()->query('
            SELECT *
            FROM ' . static::$tableName . '
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');

        $req->execute();

        return $req->fetchAll();
    }
}
