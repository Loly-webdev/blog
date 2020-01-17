<?php

require_once PROJECT_MODEL . 'DefaultManager.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleManager extends DefaultManager
{
    //protected static $tableName = 'posts';
    /**
     * Find all posts
     * @throws Exception
     */
    public static function findAll()
    {
        $req = static::getPDO()->query("
            SELECT id,
                   title,
                   content,
                   DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr
            FROM posts
            ORDER BY creation_date DESC
            LIMIT 0, 5
        ");

        $req->execute();

        return $req->fetchAll();
    }

    /**
     * Find post by id
     * @throws Exception
     */
    public static function findById($id)
    {
        $req = static::getPDO()->prepare("
           SELECT id,
                  title,
                  content,
                  DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr
           FROM posts
           WHERE id = ?
           ");

        $req->execute(array($id));

        return $req->fetch();
    }

    /**
     * Count the number of posts
     * @throws Exception
     */
    public static function count()
    {
        $req = static::getPDO()->query("
            SELECT COUNT(id) AS nb_posts
            FROM posts
        ");

        return $req->fetchColumn();
    }
}
