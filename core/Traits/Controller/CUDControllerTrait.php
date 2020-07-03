<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractRepository;
use Core\Exception\CoreException;

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
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException("Désolé, nous n'avons pas trouvé $entityName avec l'id: $entityId");
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

        $data    = $this->getRequest()->getParam($entityName);

        if (isset($data)) {
            $entity = $entity->hydrate($data);

            $updated = $repository->update($entity);

            $var = $updated;
            $success = "Votre $entityName à bien était modifié !";
            $error = "Une erreur est survenue.";

            $status = static::messageStatus($var, $success, $error);

        }

        $this->renderView(
            $viewTemplate,
            [
                $entityName => $entity,
                'status'  => $status['status'] ?? '',
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
     * @param string                    $entityLabel
     * @param string                    $viewTemplate
     */
    protected function deleteEntity(
        DefaultAbstractRepository $repository,
        string $entityParamId,
        string $entityLabel,
        string $viewTemplate
    ): void
    {
        $deleted = $repository->delete(
            $this->getRequest()
                 ->getParam($entityParamId)
        );

        $var = $deleted;
        $success = "Votre $entityLabel à bien était supprimé !";
        $error = "Une erreur est survenue.";

        $status = static::messageStatus($var, $success, $error);

        $this->renderView(
            $viewTemplate,
            [
                'status'  => $status['status'] ?? '',
                'statusMessage' => $status['statusMessage'] ?? ''
            ]
        );
    }

    public function messageStatus(string $var, string $success, string $error)
    {
        $status = $var
            ? "success"
            : "danger";

        $statusMessage = $var
            ? $success
            : $error;

        return [
            'status' => $status ?? '',
            'statusMessage' => $statusMessage ?? ''
        ];
    }
}
