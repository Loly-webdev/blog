<?php

namespace Core\Traits\Controller;

use App\Service\Message;
use Core\DefaultAbstract\DefaultAbstractRepository;
use Core\Exception\CoreException;
use LogicException;

trait CUDControllerTrait
{
    /**
     * See action of controller
     */
    public function seeAction(): void
    {
        $params = $this->getSeeParam();

        $this->seeEntity(...$params);
    }

    /**
     * Get Params of see action
     * @return array
     */
    abstract public function getSeeParam(): array;

    /**
     * Method to see entity
     *
     * @param string                    $entityParamId
     * @param string                    $entityName
     * @param DefaultAbstractRepository $repository
     * @param string                    $viewTemplate
     */
    protected function seeEntity(
        string $entityParamId,
        string $entityName,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        // Get id to the URL
        $entityId = $this->getRequest()->getParamAsInt($entityParamId);
        // Load post associate to the Id or return null
        $entity = $repository->findOneById($entityId);

        if (null === $entity) {
            // Exception that represents errors in the program logic.
            throw new LogicException("Désolé, nous n'avons pas trouvé $entityName avec l'id: $entityId");
        }

        if (method_exists($entity, 'getTitle')) {
            $title = $entity->getTitle();
        }

        $data = [
            'title'     => $title ?? '',
            $entityName => $entity
        ];

        if (method_exists($this, 'preRenderView')) {
            $data = $this->preRenderview($data, $entity);
        }

        $this->renderView(
            $viewTemplate,
            $data
        );
    }

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
