<?php

namespace Core\Traits;

use Core\DefaultAbstractRepository;
use Exception;

/**
 * Trait UpdateControllerTrait
 * @package Core\Traits
 */
trait UpdateControllerTrait
{
    /**
     * Update action of controller
     * @throws Exception
     */
    public function updateAction(): void
    {
        $params = $this->getUpdateParam();

        $this->updateEntity(...$params);
    }

    /**
     * Get Params of update action
     * @return array
     */
    abstract public function getUpdateParam(): array;

    /**
     * Method to update entity
     *
     * @param string                    $entityParamId
     * @param DefaultAbstractRepository $repository
     * @param string                    $post
     * @param string                    $viewTemplate
     *
     * @throws Exception
     */
    protected function updateEntity(
        string $entityParamId,
        DefaultAbstractRepository $repository,
        string $post,
        string $viewTemplate
    ): void
    {
        // Retrieve all data in a table
        $objectId = $this->getRequest()
                         ->getParam($entityParamId);
        $object   = $repository->findOne($objectId);
        if (!isset($object)) {
            throw new Exception('Désolé nous rencontrons un problème avec votre demande.');
        }

        $data    = $this->getRequest()
                        ->getParam($post);
        $message = '';

        if (isset($data)) {
            $object = $object->hydrate($data);
            if (array_key_exists('post', $data)) {
                unset($data['post']);
            }
            $updated = $repository->update($object);
            $message = $updated
                ? "Votre $post à bien était modifié !"
                : "Une erreur est survenue.";
        }

        $this->renderView(
            $viewTemplate,
            [
                $post     => $object,
                'message' => $message
            ]
        );
    }
}
