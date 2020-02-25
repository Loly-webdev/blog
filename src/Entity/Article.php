<?php

namespace App\Entity;

use App\Controller\ArticleController;

class Article
{
    protected $id;
    protected $title;
    protected $author;
    protected $content;
    private $params;

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

    private function setName($params)
    {
        $this->params = $params;

        return $this;
    }

    public function hasId($data)
    {
        if (null === $data) {
            (new ArticleController())->renderView(
                'articleForm.html.twig'
            );
        }
    }
}
