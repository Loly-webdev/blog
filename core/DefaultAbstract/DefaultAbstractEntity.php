<?php

namespace Core\DefaultAbstract;

/**
 * Class DefaultAbstractEntity
 * @package Core
 */
abstract class DefaultAbstractEntity
{

    protected $id;
    protected $createdAt;
    protected $updatedAt;

    /**
     * Method to hydrate an object
     *
     * @param array $params
     *
     * @return DefaultAbstractEntity
     */
    public function hydrate(array $params): DefaultAbstractEntity
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
     * Check if there's an id
     * @return bool
     */
    public function hasId(): bool
    {
        return null !== $this->id;
    }

    /**
     * Get an id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the creation date
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the updated date
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Convert to array the entity for the BDD
     * @return array
     */
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
