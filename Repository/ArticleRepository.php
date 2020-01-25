<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    public static function getTableData()
    {
        return [
                'name' => 'posts',
                'pk' => 'id',
                'order' => 'creation_date'
        ];
    }

    /**
     * Add an article to the database
     * @param $article
     * @return bool
     * @throws Exception
     */
    public function addArticle($article)
    {
        $req = $this->getPDO()->prepare('
            INSERT INTO ' . static::getTableData()['name'] . '
            (id,
            title, 
            content, 
            creation_date) 
            VALUES(?,?,?,?,NOW())
            ');

        return $req->execute(array(
            $article['id'],
            $article['title'],
            $article['content'],
            $article['creation_date']
        ));
    }
}
