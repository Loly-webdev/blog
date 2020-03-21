<?php

namespace App\Repository;

use App\Entity\Article;
use Core\DefaultAbstractRepository;

/**
 * Make the database requests relative to the articles
 */
class ArticleRepository extends DefaultAbstractRepository
{
    static $tableName = 'posts';

    public function getEntity(): string
    {
        return Article::class;
    }
}
