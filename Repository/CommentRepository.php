<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tablePk = 'post_id';
    static $tableOrder = 'comment_date';

    /**
     * This function find all comments in an article
     * @param $articleId
     * @return array
     * @throws Exception
     */
    public function findByArticleId(int $articleId)
    {
        $req = $this->getPDO()->prepare('
            SELECT * 
            FROM ' . static::$tableName . ' 
            WHERE ' . static::$tablePk . ' = ?
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');
        $req->execute(array($articleId));

        return $req->fetchAll();
    }

    public function AddComment()
    {
        if (isset($_POST['author'], $_POST['content'])) {

            $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (post_id, author, comment, comment_date)
            VALUES (:post_id, :author, :content, :creation_date)');

            $sql->execute([
                'post_id' => $_GET['id'],
                'author' => $_POST['author'],
                'content' => $_POST['content'],
                'date' => time()
            ]);
        }
        $sql = $this->getPDO()->query('SELECT* FROM ' . static::$tableName);
        $sql->fetchAll();
    }
}
