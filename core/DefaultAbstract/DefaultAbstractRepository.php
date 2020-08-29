<?php

namespace Core\DefaultAbstract;

use Core\Exception\CoreException;
use Core\Provider\PDOProvider;
use Core\Traits\Repository\{CUDRepositoryTrait, ReadRepositoryTrait};
use PDO;

/**
 * Class DefaultAbstractRepository
 * @package Core
 */
abstract class DefaultAbstractRepository
{
    use CUDRepositoryTrait,
        ReadRepositoryTrait;

    public static $tablePk    = 'id';
    public static $tableOrder = 'createdAt';
    public static $tableName;
    private       $pdo;

    /**
     * DefaultAbstractRepository constructor.
     * @throws CoreException
     */
    final public function __construct()
    {
        $this->pdo = PDOProvider::PDOConnect();

        if (!isset(static::$tableName)) {
            throw new CoreException('vous devez déclarez le nom de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tableOrder)) {
            throw new CoreException('vous devez déclarez l\'ordre de tri de la table pour la classe ' . __CLASS__);
        }
    }

    /**
     * Get entity
     * @return string
     */
    abstract public function getEntity(): string;

    /**
     * Select columns of BDD for drop-down lists
     *
     * @param array $columns
     *
     * @return array
     */
    public function selectColumns(array $columns = []): array
    {
        $sql = 'SELECT ' . implode(', ', $columns)
               . ' FROM ' . static::$tableName;

        $pdo = $this->getPDO()->query($sql);

        return $pdo->fetchAll();
    }

    /**
     * This method make the connection to the database and load the PDOProvider class
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
