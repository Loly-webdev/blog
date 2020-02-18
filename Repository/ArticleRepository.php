<?php

require_once PROJECT_ENTITY . 'Article.php';
require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';
    static $tablePk = 'id';
    static $tableOrder = 'creation_date';

    public function add(array $data)
    {
        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (title, author, content)
            VALUES (:title, :author, :content)');

        $sql->execute($data);

        $lastInsertId;

        $article = $this->getPDO()->prepare('
        SELECT*
        FROM ' . static::$tableName . '
        WHERE ' . static::$tablePk . ' = ?
        ')
            ->setParameter(['id' =>$lastInsertId])
            ->setFetchMode(
                PDO::FETCH_INTO,
                $this->getEntity()
            );

            return $article;
    }

    public function getEntity()
    {
        return new Article();
    }
}
