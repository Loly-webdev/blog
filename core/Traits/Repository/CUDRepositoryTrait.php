<?php

namespace Core\Traits\Repository;

use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Trait CUDRepositoryTrait
 * @package Core\Traits
 */
trait CUDRepositoryTrait
{
    /**
     * Create an entity
     *
     * @param DefaultAbstractEntity $entity
     *
     * @return bool
     */
    public function insert(DefaultAbstractEntity $entity): bool
    {
        $data                = $entity->convertToArray();
        $values              = array_values($data);
        $columns             = array_keys($data);
        $columns             = implode(', ', $columns);
        $columnsValues       = array_fill(1, count($data), '?');
        $columnsValuesJoined = implode(', ', $columnsValues);

        $sql = 'INSERT INTO ' . static::$tableName . '(' . $columns
               . ') VALUES (' . $columnsValuesJoined . ')';
        $pdo = $this->getPDO()->prepare($sql);

        return $pdo->execute($values);
    }

    /**
     * Update entity
     *
     * @param DefaultAbstractEntity $entity
     *
     * @return bool
     */
    public function update(DefaultAbstractEntity $entity): bool
    {
        $data          = $entity->convertToArray();
        $values        = array_values($data);
        $keys          = array_keys($data);
        $columns       = array_fill_keys($keys, ' = ?');
        $columnsValues = [];

        foreach ($columns as $key => $value) {
            $columnsValues[] = $key . $value;
        }

        $columns  = implode(', ', $columnsValues);
        $values[] = $entity->getId();

        $sql = 'UPDATE ' . static::$tableName
               . ' SET ' . $columns
               . ' WHERE ' . static::$tablePk . ' = ?';

        $pdo = $this->getPDO()->prepare($sql);

        return $pdo->execute($values);
    }

    /**
     * Delete the entry with the id find by the getParams method
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM ' . static::$tableName
               . ' WHERE ' . static::$tablePk . ' = ?';

        $pdo = $this->getPDO()->prepare($sql);

        return $pdo->execute([$id]);
    }
}
