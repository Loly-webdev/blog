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

    /**
     * Add the entry with the id find by the getParams method
     * @param $article
     * @return bool
     * @throws Exception
     */
    public static function addArticle($article)
    {
        $req = static::getPDO()->prepare('
            INSERT INTO ' . static::getTableName() . '
            (id,
            title, 
            content, 
            creation_date) 
            VALUES(?,?,?,?,NOW())
            WHERE ' . static::getTablePk() . ' = ?
            ');

        return $req->execute(array(
            $article['id'],
            $article['title'],
            $article['content'],
            $article['creation_date'],
        ));
    }

}
