<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class Comment
 * @package App\Entity
 */
class Comment extends DefaultAbstractEntity
{

    protected $author;
    protected $content;
    protected $articleId;

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
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
