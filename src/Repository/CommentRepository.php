<?php

namespace App\Repository;

use Core\DefaultAbstractRepository;
use App\Entity\Comment;

/**
 * Class CommentRepository
 * @package App\Repository
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return Comment::class;
    }
}
