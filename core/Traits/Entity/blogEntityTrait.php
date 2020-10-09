<?php

namespace Core\Traits\Entity;

/**
 * Trait blogEntityTrait
 * @package Core\Traits\Entity
 */
trait blogEntityTrait
{
    protected $author  = '';
    protected $content = '';

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
