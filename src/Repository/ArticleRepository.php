<?php

namespace App\Repository;

use App\Entity\Article;
use Core\DefaultAbstractRepository;
use PDO;

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName  = 'posts';
    static $tablePk = 'post_id';
    static $tableOrder = 'creation_date';

    public function add(array $data)
    {
        $sql = 'INSERT INTO ' . static::$tableName . ' (title, author, content)
            VALUES (:title, :author, :content)';

        $pdo = $this->getPDO()->prepare($sql);
        //$pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute($data);

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

    public function update($id): int
    {
        $sql = 'UPDATE ' . static::$tableName
               . ' SET title = :title, content = :content '
               . ' WHERE ' . static::$tablePk . ' = ?';

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->setFetchMode(PDO::FETCH_CLASS, $this->getEntity());
        $pdo->execute([$id]);

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

    public function getEntity()
    {
        return Article::class;
    }
}
