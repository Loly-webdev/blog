<?php

namespace Core\Traits;

use Core\DefaultAbstractRepository;

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
     * @param string                    $viewTemplate
     * @param string                    $message
     */
    protected function deleteEntity(
        DefaultAbstractRepository $repository,
        string $entityParamId,
        string $viewTemplate,
        string $message
    ): void
    {
        $repository->delete(
            $this->getRequest()
                 ->getParam($entityParamId)
        );

        $this->renderView(
            $viewTemplate,
            [
                'message' => $message
            ]
        );
    }
}
