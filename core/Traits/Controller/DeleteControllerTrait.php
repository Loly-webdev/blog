<?php

namespace Core\Traits\Controller;

use App\Service\Message;
use Core\DefaultAbstract\DefaultAbstractRepository;

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
     * @return array
     */
    abstract public function getDeleteParam(): array;

    /**
     * Method to delete entity
     *
     * @param DefaultAbstractRepository $repository
     * @param string                    $entityParamId
     * @param string                    $viewTemplate
     */
    protected function deleteEntity(
        DefaultAbstractRepository $repository,
        string $entityParamId,
        string $viewTemplate
    ): void
    {
        $status = Message::getMessage(
            $repository->delete($this->getRequest()
                                     ->getParam($entityParamId)),
            'Votre ' . static::$entityLabel . ' à bien était supprimé !',
            'Une erreur est survenue.');

        $this->renderView(
            $viewTemplate,
            [
                'status'        => $status['status'] ?? '',
                'statusMessage' => $status['statusMessage'] ?? ''
            ]
        );
    }
}
