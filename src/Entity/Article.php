<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class Article
 * @package App\Entity
 */
class Article extends DefaultAbstractEntity
{
    /**
     * @var mixed
     */
    protected $title;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

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
     * @return Article
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
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
