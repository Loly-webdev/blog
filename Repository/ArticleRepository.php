<?php

require_once PROJECT_REPOSITORY . 'DefaultRepository.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultRepository
{
    public static function getTableName()
    {
        return 'posts';
    }

    public static function getTablePk()
    {
        return 'id';
    }

    public static function getOrderBy()
    {
        return 'creation_date';
    }

    /**
     * Add the entry with the id find by the getParams method
     * @param $article
     * @param $articleId
     * @return bool
     * @throws Exception
     */
    public static function addArticle($article, $articleId)
    {
        $req = static::getPDO()->prepare('
            INSERT INTO ' . static::getTableName() . '
            (id,
            title, 
            content, 
            creation_date) 
            VALUES(?,?,?,?,NOW())
            ');

        return $req->execute(array(
            $articleId,
            $article['id'],
            $article['title'],
            $article['content'],
            $article['creation_date']
        ));
    }
}
