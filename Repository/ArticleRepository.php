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

    public function AddArticle()
    {
        if (isset($_POST['title'], $_POST['content'])) {

            $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (title, author, content, creation_date)
            VALUES (:title, :author, :content, :creation_date)');

            $sql->execute([
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'content' => $_POST['content'],
                'date' => time()
            ]);
        }
        $sql = $this->getPDO()->query('SELECT* FROM ' . static::$tableName);
        $sql->fetchAll();
    }
}
