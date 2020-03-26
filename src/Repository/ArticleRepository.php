<?php

namespace App\Repository;

use App\Entity\Article;
use Core\DefaultAbstractRepository;

/**
 * Class ArticleRepository
 * @package App\Repository
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return Article::class;
    }
}
