<?php

namespace App\Repository;

use App\Entity\Comment;
use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Class CommentRepository
 * @package App\Repository
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    public static $tableName = 'comment';

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return Comment::class;
    }
}
