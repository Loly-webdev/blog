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
     * @param int $id
     *
     * @return DefaultAbstractEntity
     */
    public function findOneById(int $id): ?DefaultAbstractEntity
    {
        $data = $this->find(
            [
                static::$tablePk => $id
            ]
        );

        return reset($data)
            ? reset($data)
            : null;
    }

    /**
     * Polymorphism method
     *
     * @param array|null $filters
     *
     * @return mixed
     */
    public function findOne(?array $filters = [])
    {
        $filters['limit'] = 1;
        $data = $this->search($filters);

        return !empty($data)
            ? reset($data)
            : null;
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
        return $this->search($filters);
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
        $limit = $filters['limit'] ?? null;
        $orderBy = $filters['orderBy'] ??  static::$tableOrder . ' DESC';
        unset($filters['limit'], $filters['orderBy']);

        // We specify a where 1 = 1 to avoid managing the WHERE || AND
        $sql = ' SELECT * FROM ' . static::$tableName . ' WHERE 1 = 1 ';

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        $sql .= 'ORDER BY ? ';
        $filters[] = $orderBy;

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute(array_values($filters));
        $data = $pdo->fetchAll();

        return $limit
            ? array_slice($data, 0, $limit)
            : $data;
    }
}
