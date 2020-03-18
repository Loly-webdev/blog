<?php

namespace Core;

use Exception;
use PDO;

abstract class DefaultAbstractRepository
{
    static  $tablePk = 'id';
    static $tableOrder = 'createdAt';
    private $pdo;

    final public function __construct()
    {
        $this->pdo = DefaultPDO::PDOConnect();

        if (!isset(static::$tableName)) {
            throw new Exception('vous devez déclarez le nom de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tableOrder)) {
            throw new Exception('vous devez déclarez l\'ordre de tri de la table pour la classe ' . __CLASS__);
        }
    }

    /**
     * Polymorphism method
     *
     * @param null $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function find($filters = null)
    {
        if (is_numeric($filters)) {
            return $this->findOne($filters);
        }
        elseif (is_array($filters) && !empty($filters)) {
            return $this->search($filters);
        }

        return $this->findAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     *
     * @param $articleId
     *
     * @return mixed
     * @throws Exception
     */
    public function findOne(int $articleId)
    {
        // SQL REQUEST
        $sql = 'SELECT * FROM ' . static::$tableName
               . ' WHERE ' . static::$tablePk . ' = ?';

        // PDO execute
        $pdo = $this->getPDO()->prepare($sql);
        // Object of value
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        // We pass the values to be replaced by the ? values of the sql query.
        $pdo->execute([$articleId]);

        // We're getting the results back
        return $pdo->fetch();
    }

    /**
     * This method make the connection to the database and load the DefaultPDO class
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    public abstract function getEntity();

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return array An empty table where the results can be found in bdd
     */
    public function search(array $filters)
    {
        // We specify a where 1 = 1 to avoid managing the WHERE || AND
        $sql = ' SELECT * FROM ' . static::$tableName . ' WHERE 1 = 1 ';

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        // We pass the values to be replaced by the ? values of the sql query.
        $pdo->execute(array_values($filters));

        return $pdo->fetchAll();
    }

    /**
     * This function find all the informations contained in the table
     */
    public function findAll()
    {
        $sql = 'SELECT *  FROM ' . static::$tableName
               . ' ORDER BY ' . static::$tableOrder . ' DESC';

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute();

        return $pdo->fetchAll();
    }


    public function insert($data)
    {
        $key = array_keys($data);
        $val = array_values($data);
        $table = static::$tableName;

        $sql   = "INSERT INTO $table (" . implode(', ', $key) . ") "
                 . "VALUES ('" . implode("', '", $val) . "')";

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->execute($data);

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

    public function update($data)
    {
        $key = array_keys($data);
        $val = array_values($data);
        $table = static::$tableName;

        $sql   = "UPDATE $table (" . implode(', ', $key) . ") "
                 . "SET ('" . implode("', '", $val) . "')";

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->execute($data);

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

    /**
     * Delete the entry with the id find by the getParams method
     *
     * @param $id
     *
     * @return void
     * @throws Exception
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM ' . static::$tableName
               . ' WHERE ' . static::$tablePk . ' = ?';

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute([$id]);

        // The number of deleted entries is displayed.
        return $pdo->rowCount();
    }

    public function selectColumns(array $columns = [])
    {
        $sql = 'SELECT ' . implode(', ', $columns)
               . ' FROM ' . static::$tableName;

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll();
    }
}
