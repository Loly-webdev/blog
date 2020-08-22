<?php

namespace Core\Traits\Controller;

use App\Service\Message;
use Core\DefaultAbstract\DefaultAbstractRepository;
use Core\Exception\CoreException;

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
        $entityId = $this->getRequest()->getParamAsInt($entityParamId);
        if (!isset($entityId)) {
            throw new CoreException("Désolé nous ne trouvons pas les paramétres de l'entité $entityParamId.");
        }

        $entity = $repository->findOneById($entityId);
        if (!isset($entity)) {
            throw new CoreException('Désolé nous rencontrons un problème avec votre demande.');
        }

        $data = $this->getRequest()->getParam($entityName);

        if (isset($data)) {
            $entity = $entity->hydrate($data);

            $status = Message::getMessage(
                $repository->update($entity),
                'Votre ' . static::$entityLabel . ' à bien été modifié !',
                'Une erreur est survenue.');
        }

        $this->renderView(
            $viewTemplate,
            [
                $entityName     => $entity,
                'status'        => $status['status'] ?? '',
                'statusMessage' => $status['statusMessage'] ?? ''
            ]
        );
    }
}
