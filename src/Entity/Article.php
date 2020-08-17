<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class Article
 * @package App\Entity
 */
class Article extends DefaultAbstractEntity
{
    protected $title;
    protected $author;
    protected $hat;
    protected $content;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Article
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;

        return $this;
    }

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
     * @return Article
     */
    public function setAuthor(string $author): Article
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getHat(): string
    {
        return $this->hat;
    }

    /**
     * @param string $hat
     *
     * @return Article
     */
    public function setHat(string $hat): Article
    {
        $this->hat = $hat;

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
     * @return Article
     */
    public function setContent(string $content): Article
    {
        $this->content = $content;

        return $this;
    }
}
