<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractRepository;
use Core\Exception\CoreException;

/**
 * Trait EditControllerTrait
 * @package Core\Traits
 */
trait EditControllerTrait
{
    /**
     * Update action of controller
     * @throws CoreException
     */
    public function editAction(): void
    {
        $params = $this->getEditParam();

        $this->editEntity(...$params);
    }

    /**
     * Get Params of edit action
     * @return array
     */
    abstract public function getEditParam(): array;

    /**
     * Method to edit entity
     *
     * @param string                    $entityParamId
     * @param DefaultAbstractRepository $repository
     * @param string                    $post
     * @param string                    $viewTemplate
     *
     * @throws CoreException
     */
    protected function editEntity(
        string $entityParamId,
        DefaultAbstractRepository $repository,
        string $post,
        string $viewTemplate
    ): void
    {
        // Retrieve all data in a table
        $objectId = $this->getRequest()->getParam($entityParamId);
        if (!isset($objectId)) {
            throw new CoreException('The "'. $entityParamId .'" paramater was not founded.');
        }

        $object   = $repository->findOne($objectId);
        if (!isset($object)) {
            throw new CoreException('Désolé nous rencontrons un problème avec votre demande.');
        }

        $data    = $this->getRequest()->getParam($post);
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
