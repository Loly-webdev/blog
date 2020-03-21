<?php

namespace App\Repository;

use Core\DefaultAbstractRepository;
use App\Entity\Comment;

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';

    public function getEntity(): string
    {
        return Comment::class;
    }
}
