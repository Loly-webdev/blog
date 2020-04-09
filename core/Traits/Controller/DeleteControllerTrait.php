<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Trait DeleteControllerTrait
 * @package Core\Traits
 */
trait DeleteControllerTrait
{
    /**
     * Delete action of controller
     */
    public function deleteAction(): void
    {
        $params = $this->getDeleteParam();

        $this->deleteEntity(...$params);
    }

    /**
     *  Get Params of delete action
     *
     * @return array
     */
    abstract public function getDeleteParam(): array;

    /**
     * Method to delete entity
     *
     * @param DefaultAbstractRepository $repository
     * @param string                    $entityParamId
     * @param string                    $entityName
     * @param string                    $viewTemplate
     */
    protected function deleteEntity(
        DefaultAbstractRepository $repository,
        string $entityParamId,
        string $entityName,
        string $viewTemplate
    ): void
    {
        $message = '';

        $deleted = $repository->delete(
            $this->getRequest()
                 ->getParam($entityParamId)
        );

        $message = $deleted
            ? "Votre $entityName à bien était supprimé !"
            : "Une erreur est survenue.";

        $this->renderView(
            $viewTemplate,
            [
                'message' => $message
            ]
        );
    }
}
