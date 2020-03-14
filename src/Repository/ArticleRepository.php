<?php

namespace App\Repository;

use App\Entity\Article;
use Core\DefaultAbstractEntity;
use Core\DefaultAbstractRepository;
use PDO;

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName  = 'posts';
    static $tableOrder = 'creation_date';

    public function add($data)
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

    public function getEntity()
    {
        return Article::class;
    }
}
