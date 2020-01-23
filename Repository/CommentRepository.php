<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    public static function getTableData()
    {
        return array(
            'name' => 'comments',
            'pk' => 'post_id',
            'order' => 'comment_date'
        );
    }

    /**
     * Add a comment to the database
     * @param $comment [an array of the params of the new comment]
     * @return bool
     * @throws Exception
     */
    public static function addComment($comment)
    {
        $req = static::getPDO()->prepare('
            INSERT INTO ' . static::getTableData()['name'] . '
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
