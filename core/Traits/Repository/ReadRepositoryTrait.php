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
     * @param array|mixed[] $filters
     *
     * @return DefaultAbstractEntity[]
     * If no match returns an empty array otherwise an array of DefaultAbstractEntity
     */
    public function find(array $filters = []): array
    {
        return $this->search($filters);
    }

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array|mixed[] $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return DefaultAbstractEntity[] If no match returns an empty array otherwise an array of DefaultAbstractEntity
     */
    public function search(array $filters = []): array
    {
        $limit = isset($filters['limit']) && is_int($filters['limit']) ? $filters['limit'] : null;
        $orderBy = isset($filters['orderBy']) && is_int($filters['orderBy']) ? $filters['orderBy'] : 1;
        $sorted = isset($filters['sorted']) && true === $filters['sorted'] ? 'ASC' : 'DESC';
        unset($filters['limit'], $filters['orderBy'], $filters['sorted']);

        // We specify a where 1 = 1 to avoid managing the WHERE || AND
        $sql = ' SELECT * FROM ' . static::$tableName . ' WHERE 1 = 1 ';

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        $sql .= "ORDER BY $orderBy $sorted";

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute(array_values($filters));
        $data = $pdo->fetchAll();

        return $limit
            ? array_slice($data, 0, $limit)
            : $data;
    }

    /**
     * Polymorphism method
     *
     * @param array|mixed[] $filters
     *
     * @return DefaultAbstractEntity|null ?DefaultAbstractEntity
     */
    public function findOne(array $filters = []): ?DefaultAbstractEntity
    {
        $filters['limit'] = 1;
        $data = $this->search($filters);

        return !empty($data)
            ? reset($data)
            : null;
    }
}
