<?php

namespace Core\Traits\Repository;

use Core\DefaultAbstract\DefaultAbstractEntity;
use PDO;

/**
 * Trait ReadRepositoryTrait
 * @package Core\Traits
 */
trait ReadRepositoryTrait
{
    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     *
     * @param int $articleId
     *
     * @return DefaultAbstractEntity
     */
    public function findOne(int $articleId): ?DefaultAbstractEntity
    {
        $data = $this->find([
            static::$tablePk =>  $articleId
        ]);

        return reset($data)
            ? reset($data)
            : null
            ;
    }

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
     * This function find all the informations contained in the table
     */
    public function findAll(): array
    {
        return $this->search();
    }

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array|null $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return DefaultAbstractEntity[] If no match returns an empty array otherwise an array of DefaultAbstractEntity
     */
    public function search(?array $filters = []): array
    {
        // We specify a where 1 = 1 to avoid managing the WHERE || AND
        $sql = ' SELECT * FROM ' . static::$tableName . ' WHERE 1 = 1 ';

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        $sql .= ' ORDER BY ' . static::$tableOrder . ' DESC';

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute(array_values($filters));

        return $pdo->fetchAll();
    }
}
