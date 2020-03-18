<?php

namespace Core;

use DateTime;
use Exception;

abstract class DefaultAbstractEntity
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;

    public function __construct(?array $params = [])
    {
        if (!empty($params)) {
            $this->hydrateObject($params);
        }
    }

    public function hydrateObject($params)
    {
        foreach ($params as $key => $data) {
            // We retrieve the name of the setter corresponding to the class attribute.
            $method = 'set' . ucfirst($key);
            // If the corresponding setter exists, it is called up.
            if (method_exists($this, $method)) {
                $this->$method($data);
            }
        }
    }

    /**
     * @return bool
     */
    public function hasId(): bool
    {
        return null !== $this->id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function convertToArray(): array
    {
        return get_object_vars($this);
    }
}
