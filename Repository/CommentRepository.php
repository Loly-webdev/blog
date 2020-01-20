<?php

require_once PROJECT_REPOSITORY . 'DefaultRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultRepository
{
    public static function getTableName()
    {
        return 'comments';
    }

    /**
     * Add a comment to the database
     * @param $articleId
     * @param $comment [an array of the params of the new comment]
     * @return bool
     * @throws Exception
     */
    public static function add($articleId, $comment)
    {
        $req = static::getPDO()->prepare('
            INSERT INTO ' . static::getTableName() . '
            (id, 
            post_id,
            author, 
            comment, 
            comment_date)
            VALUES(?, ?, ?, ?, ?, NOW())'
        );

        return $req->execute(array(
            $articleId,
            $comment['id'],
            $comment['post_id'],
            $comment['author'],
            $comment['comment'],
            $comment['comment_date']
        ));
    }
}
