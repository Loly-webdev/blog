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
    public function findByArticleId($articleId)
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

    /**
     * Add a comment to the database
     * @param $comment [an array of the params of the new comment]
     * @return bool
     * @throws Exception
     */
    public function addComment($comment)
    {
        $req = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (id, 
            post_id,
            author, 
            comment, 
            comment_date)
            VALUES(?, ?, ?, ?, ?, NOW())'
        );

        return $req->execute(array(
            $comment['id'],
            $comment['post_id'],
            $comment['author'],
            $comment['comment'],
            $comment['comment_date']
        ));
    }
}
