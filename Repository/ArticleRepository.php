<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';
    static $tableOrder = 'creation_date';

    public function addArticle(array $data)
    {
        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (title, author, content)
            VALUES (:title, :author, :content)');

        $sql->execute($data);
    }
}
