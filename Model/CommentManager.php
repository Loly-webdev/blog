<?php
require_once PROJECT_MODEL . 'DefaultManager.php';

/**
 * Make the database requests relative to the comments
 */
class CommentManager extends DefaultManager
{
    //protected static $tableName = 'comments';

    /**
     * Find the 50 last comments that belongs to the selected article
     * @param $id [the id of the article]
     * @return array
     * @throws Exception
     */
    public static function findComments($id)
    {
        $req = static::getPDO()->prepare("
            SELECT * 
            FROM comments 
            WHERE post_id
            ORDER BY comment_date DESC 
            LIMIT 0,30
        ");
        $req->execute(array($id));
        return $req->fetchAll();
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
        $req = static::getPDO()->prepare("
            INSERT INTO comments(
                                 post_id, 
                                 author, 
                                 comment, 
                                 comment_date)
            VALUES(?, ?, ?, NOW())
        ");
        return $req->execute(array(
            $articleId,
            $comment['name'],
            $comment['message']
        ));
    }
}
