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
     * @param string                    $entityName
     * @param string                    $viewTemplate
     *
     * @throws CoreException
     */
    protected function editEntity(
        string $entityParamId,
        DefaultAbstractRepository $repository,
        string $entityName,
        string $viewTemplate
    ): void
    {
        // Retrieve all data in a table
        $entityId = $this->getRequest()->getParam($entityParamId);
        if (!isset($entityId)) {
            throw new CoreException("Désolé nous ne trouvons pas les paramétres de l'entité $entityParamId.");
        }

        $entity = $repository->findOne($entityId);
        if (!isset($entity)) {
            throw new CoreException('Désolé nous rencontrons un problème avec votre demande.');
        }

        $data    = $this->getRequest()->getParam($entityName);
        $message = '';

        if (isset($data)) {
            $entity = $entity->hydrate($data);
            if (method_exists($this, 'keyExist')) {
                $this->keyExist($data);
            }

            $updated = $repository->update($entity);
            $message = $updated
                ? "Votre $entityName à bien était modifié !"
                : "Une erreur est survenue.";
        }

        $this->renderView(
            $viewTemplate,
            [
                $entityName => $entity,
                'message'   => $message
            ]
        );
    }
}
