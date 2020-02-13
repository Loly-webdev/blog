<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tableOrder = 'comment_date';

    /**
     * This function find all comments in an article
     * @param int $articleId
     * @param string $postId
     * @return array
     * @throws Exception
     */
    public function findByArticleId(int $articleId, $postId = 'post_id')
    {
        $sql = $this->getPDO()->prepare('
            SELECT * 
            FROM ' . static::$tableName . ' 
            WHERE ' . $postId . ' = ?
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');
        $sql->execute(array($articleId));

        return $sql->fetchAll();
    }

    public function addComment(array $data)
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
}
