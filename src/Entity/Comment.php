<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;

class Comment extends DefaultAbstractEntity
{
    protected $post;
    protected $author;
    protected $content;

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     *
     * @return Comment
     */
    public function setPost($post)
    {
        $this->post = $post;

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
