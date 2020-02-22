<?php

require_once PROJECT_ENTITY . 'Comment.php';
require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tableOrder = 'comment_date';

    public function add(array $data)
    {
        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (post_id, author, content)
            VALUES (:post_id, :author, :content)');

       // $sql->execute($data);

        $sql->execute(
            ['post_id' => (int)$_GET['articleId'],
                'author' => $data['author'],
                'content' => $data['content']]
        );

        //$lastInsertId = $sql->lastInsertId();

        return $this->getPDO()->prepare('
        SELECT*
        FROM ' . static::$tableName . '
        WHERE ' . static::$tablePk . ' = ?
        ')
            //->setParameter(['id' => $lastInsertId])
            ->setFetchMode(
                PDO::FETCH_INTO,
                $this->getEntity()
            );
    }

    public function getEntity()
    {
        return new Comment();
    }
}
