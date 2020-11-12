<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Traits\Entity\blogEntityTrait;

/**
 * Class Article
 * @package App\Entity
 */
class Article extends DefaultAbstractEntity
{
    use blogEntityTrait;

    protected $title = '';
    protected $hat   = '';

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
