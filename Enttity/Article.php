<?php


class Article
{
    protected $name;
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
        if (isset($params['name'])) {
            $this->setName($params['name']);
        }

        if (isset($params['author'])) {
            $this->setName($params['author']);
        }

        if (isset($params['content'])) {
            $this->setName($params['content']);
        }
    }
}
