<?php

namespace Core;

use Exception;

abstract class DefaultAbstractEntity
{
    protected $id;
    protected $createdAt;
    protected $updatedAt;

    public function hydrate(array $params)
    {
        foreach ($params as $key => $data) {
            // We retrieve the name of the setter corresponding to the class attribute.
            $method = 'set' . ucfirst($key);
            // If the corresponding setter exists, it is called up.
            if (method_exists($this, $method)) {
                $this->$method($data);
            }
        }
        return $this;
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
        $data = get_object_vars($this);

        unset(
            $data['id'],
            $data['createdAt']
        );

        if (array_key_exists('updatedAt', $data)) {
            $data['updatedAt'] = date("Y-m-d H:i:s");
        }

        return $data;
    }
}
