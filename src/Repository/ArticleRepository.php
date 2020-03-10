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

    public function add2(DefaultAbstractEntity $entity)
    {
        var_dump($entity);
        $data = get_object_vars($entity);
        var_dump($data);

        //faire le $sql en dynamique
        //array_keys();
        //implode(', ');
        //if pas id faire insert into
        //if id update
        //faire methode save qui soit fait insert soit update

        //$sql = 'INSERT INTO ' . static::$tableName . ' (title, author, content)
        // VALUES (:title, :author, :content)';

        $key = array_keys($data);
        $val = array_values($data);
        var_dump($key, $val);
        die('fin');

        $table = static::$tableName;
        $sql = "INSERT INTO $table (" . implode(', ', $key) . ") "
               . "VALUES ('" . implode("', '", $val) . "')";

        $pdo = $this->getPDO()->prepare($sql);
        $pdo->execute($data);

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

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
