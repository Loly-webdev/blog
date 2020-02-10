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
        if (isset($_POST['article'])) {

            $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (title, author, content)
            VALUES (:title, :author, :content)
            ');

            // Récuperer les données via $data = $request->get('monFormulaire');
            $data = Request::getInstance()->getParam('article');

            $sql->execute([
                'title' => $data[0],
                'author' => $data[1],
                'content' => $data[2]
            ]);
        }
        $sql = $this->getPDO()->query('SELECT* FROM ' . static::$tableName);
        $sql->fetchAll();
    }
}
