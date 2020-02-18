<?php

require_once PROJECT_ENTITY . 'Comment.php';
require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tablePk = 'post_id';
    static $tableOrder = 'comment_date';

    public function findByArticleId(int $articleId)
    {
        $sql = $this->getPDO()->prepare('
            SELECT * 
            FROM ' . static::$tableName . ' 
            WHERE ' . static::$tablePk . ' = ?
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');
        $sql->execute(array($articleId));

        return $sql->fetchAll();
    }

    public function add(array $data)
    {
        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (post_id, author, content)
            VALUES (:post_id, :author, :content)');

        $sql->execute(
            ['post_id' => (int)$_GET['articleId'],
                'author' => $data['author'],
                'content' => $data['content']]
        );
    }

    public function getEntity()
    {
        return new Comment();
    }
}
