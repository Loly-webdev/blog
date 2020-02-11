<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';
    static $tablePk = 'id';
    static $tableOrder = 'creation_date';

    public function AddArticle($data)
    {
        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (title, author, content)
            VALUES (:title, :author, :content)');

        $sql->execute($data);
        var_dump($data);
        var_dump(array_column($data, 'title'));
        $this->selectColumns($data);

        $sql = $this->getPDO()->query('SELECT* FROM ' . static::$tableName);
        $sql->fetchAll();
    }

    public function selectColumns(array $data = [])
    {
        $title = array_column($data, 'title');
        print_r($title);
    }
}
