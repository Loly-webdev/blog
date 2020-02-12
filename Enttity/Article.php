<?php

namespace App\Entity;

class Article
{
    protected $title;
    protected $author;
    protected $content;

    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            $this->hydrateObject($params);
        }
    }

    public function hydrateObject($params)
    {
        if (isset($params['title'])) {
            $this->setName($params['title']);
        }

        if (isset($params['author'])) {
            $this->setName($params['author']);
        }

        if (isset($params['content'])) {
            $this->setName($params['content']);
        }
    }
}
