<?php

namespace Core;

use Exception;

abstract class DefaultAbstractRepository
{
    private $pdo;
    static $tablePk = 'id';

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

    public abstract function getEntity();

    /**
     * Polymorphism method
     * @param null $filters
     * @return mixed
     * @throws Exception
     */
    public function find($filters = null)
    {
        if (is_numeric($filters)) {
            return $this->findOne($filters);
        } elseif (is_array($filters) && !empty($filters)) {
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
        $sql = $this->getPDO()->prepare(
        	'SELECT * FROM ' . static::$tableName
			. ' WHERE ' . static::$tablePk . ' = ? '
		);

        $sql->execute([$articleId]);

        return $sql->fetch();
    }

    /**
     * This method make the connection to the database and load the DefaultPDO class
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return array An empty table where the results can be found in bdd
     */
    public function search(array $filters)
    {
        // SQL REQUEST
        // We specify a where 1 = 1 to avoid managing the WHERE || AND
        $sql = 'SELECT * FROM ' . static::$tableName . ' WHERE 1 = 1 ';

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        // PDO execute
        $pdo = $this->getPDO()->prepare($sql);

        // We pass the values to be replaced by the ? values of the sql query.
        $pdo->execute(array_values($filters));

        // We're getting the results back
        return $pdo->fetchAll();
    }

    /**
     * This function find all the informations contained in the table
     */
    public function findAll()
    {
        $sql = $this->getPDO()->query(
        	' SELECT *  FROM ' . static::$tableName
	        . ' ORDER BY ' . static::$tableOrder . ' DESC '
		);

        $sql->execute();

        return $sql->fetchAll();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $id
     * @return void
     * @throws Exception
     */
    public function delete($id)
    {
        $sql = $this->getPDO()->prepare(
        	'DELETE FROM ' . static::$tableName
			. ' WHERE ' . static::$tablePk . ' = ? '
		);

        $sql->execute([$id]);

        // The number of deleted entries is displayed.
        return $sql->rowCount();
    }

    public function updateById($id): int
    {

        $sql = $this->getPDO()->prepare(
        	'UPDATE ' . static::$tableName
			. 'SET title = :title, content = :content '
			. 'WHERE ' . static::$tablePk . ' = ?'
		);

        $sql->execute([$id]);

        // The number of updated entries is displayed.
        return $sql->rowCount();
    }

    public function selectColumns(array $columns = [])
    {
        $sql = $this->getPDO()->prepare(
        	'SELECT ' . implode(', ', $columns)
			. ' FROM ' . static::$tableName
        );

        $sql->execute();

        return $sql->fetchAll();
    }
}
