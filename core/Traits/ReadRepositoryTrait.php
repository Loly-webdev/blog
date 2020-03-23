<?php

namespace Core\Traits;

use Core\DefaultAbstractEntity;
use PDO;

trait ReadRepositoryTrait
{
    /**
     * Polymorphism method
     *
     * @param array|null $filters
     *
     * @return mixed
     */
    public function find(?array $filters = null): array
    {
        if (is_array($filters) && !empty($filters)) {
            return $this->search($filters);
        }

        return $this->findAll();
    }

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array|null $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return array An empty table where the results can be found in bdd
     */
    public function search(?array $filters): array
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
    public function findAll(): array
    {
        $sql = 'SELECT *  FROM ' . static::$tableName
               . ' ORDER BY ' . static::$tableOrder . ' DESC';

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute();

        return $pdo->fetchAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     *
     * @param int $articleId
     *
     * @return DefaultAbstractEntity
     */
    public function findOne(int $articleId): DefaultAbstractEntity
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
}
