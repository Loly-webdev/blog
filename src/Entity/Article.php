<?php

namespace App\Entity;

use Core\DefaultAbstractEntity;

class Article extends DefaultAbstractEntity
{
    protected $title;
    protected $author;
    protected $content;
    protected $name;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    private function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
