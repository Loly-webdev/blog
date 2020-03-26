<?php

namespace Core;

use Exception;
use PDO;
use Core\Traits\{
    CUDRepositoryTrait,
    ReadRepositoryTrait
};

/**
 * Class DefaultAbstractRepository
 * @package Core
 */
abstract class DefaultAbstractRepository
{
    use CUDRepositoryTrait,
        ReadRepositoryTrait;

    static  $tablePk    = 'id';
    static  $tableOrder = 'createdAt';
    private $pdo;

    /**
     * DefaultAbstractRepository constructor.
     * @throws Exception
     */
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
     * Get entity
     * @return string
     */
    public abstract function getEntity(): string;

    /**
     * Select columns of BDD for drop-down lists
     *
     * @param array $columns
     *
     * @return array
     */
    public function selectColumns(array $columns = [])
    {
        $sql = 'SELECT ' . implode(', ', $columns)
               . ' FROM ' . static::$tableName;

        $pdo = $this->getPDO()
                    ->prepare($sql);
        $pdo->execute();

        return $pdo->fetchAll();
    }

    /**
     * This method make the connection to the database and load the DefaultPDO class
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
