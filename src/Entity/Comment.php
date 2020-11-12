<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Traits\Entity\blogEntityTrait;

/**
 * Class comment
 * @package App\Entity
 */
class Comment extends DefaultAbstractEntity
{
    use blogEntityTrait;

    protected $articleId = '';
    protected $approved  = 'non';

    /**
     * @return string
     */
    public function getApproved(): string
    {
        return $this->approved;
    }

    /**
     * @param string $approved
     *
     * @return Comment
     */
    public function setApproved(string $approved): Comment
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * @param string $author
     *
     * @return Comment
     */
    public function setAuthor(string $author): Comment
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param string $content
     *
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @param int $articleId
     *
     * @return Comment
     */
    public function setArticleId(int $articleId): Comment
    {
        $this->articleId = $articleId;

        return $this;
    }
}
