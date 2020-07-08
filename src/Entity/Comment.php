<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class Comment
 * @package App\Entity
 */
class Comment extends DefaultAbstractEntity
{
    /**
     * @var mixed
     */
    protected $author;
    /**
     * @var mixed
     */
    protected $content;

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     *
     * @return Comment
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
