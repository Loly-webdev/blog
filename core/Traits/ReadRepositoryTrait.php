<?php

namespace Core\Traits;

use Exception;
use PDO;

trait ReadRepositoryTrait
{
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
}
