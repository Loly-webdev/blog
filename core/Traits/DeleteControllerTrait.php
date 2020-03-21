<?php

namespace Core\Traits;

use Core\DefaultAbstractRepository;

trait DeleteControllerTrait
{
    protected function deleteEntity(
        DefaultAbstractRepository $repository,
        int $entityParamId,
        string $viewTemplate,
        string $message
    ): void {
        $repository->delete(
            $this->getRequest()->getParam($entityParamId)
        );

        $this->renderView(
            $viewTemplate,
            [
                'message' => $message
            ]
        );
    }

    public function deleteAction(): DeleteControllerTrait
    {
        $params = $this->getDeleteParam();

        $this->deleteEntity(...$params);
    }

    abstract public function getDeleteParam();
}
