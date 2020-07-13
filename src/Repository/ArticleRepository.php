<?php

namespace App\Repository;

use App\Entity\Article;
use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Class ArticleRepository
 * @package App\Repository
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'article';

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return Article::class;
    }
}
