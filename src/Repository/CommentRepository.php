<?php

namespace App\Repository;

use Core\DefaultAbstractRepository;
use App\Entity\Comment;
use PDO;

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tablePk = 'id';
    static $tableOrder = 'comment_date';

    public function add(array $data)
    {
        $sql = 'INSERT INTO ' . static::$tableName . ' (post_id, author, content)
            VALUES (:post_id, :author, :content)';

        $pdo = $this->getPDO()->prepare($sql);

        $pdo->execute(
            [
                'post_id' => (int)$_GET['articleId'],
                'author' => $data['author'],
                'content' => $data['content']
            ]
        );

        // The number of updated entries is displayed.
        return $pdo->rowCount();
    }

    public function getEntity()
    {
        return Comment::class;
    }
}
