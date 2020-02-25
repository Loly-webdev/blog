<?php

namespace App\Repository;

use Core\DefaultAbstractRepository;
use App\Entity\Article;

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';
    static $tableOrder = 'creation_date';

    public function add(array $data)
    {
        $sql = $this->getPDO()->prepare(
        	' INSERT INTO ' . static::$tableName
            . ' (title, author, content)
            VALUES (:title, :author, :content) '
		);

        $sql->execute($data);
    }

    public function getEntity()
    {
        return Article::class;
    }
}
