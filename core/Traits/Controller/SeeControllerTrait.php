<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Trait SeeControllerTrait
 * @package Core\Traits
 */
trait SeeControllerTrait
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
        $entityId = $this->getRequest()->getParam($entityParamId);

        if (null === $entityId) {
            throw new \InvalidArgumentException(
                "Désolé, mais la valeur de $entityName n'est pas renseignée."
            );
        }

        // Load post associate to the Id or return null
        $entity = $repository->findOne($entityId);
        if (null === $entity) {
            if (method_exists($this, 'entityIdAssociate')) {
                $entityId = $this->entityIdAssociate();
            }
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException(
                "Désolé, nous n'avons pas trouvé $entityName avec l'id: $entityId");
        }

        $data = [
            $entityName => $entity
        ];

        if (method_exists($this, 'preRenderView')) {
            $data = $this->preRenderview($data);
        }

        $this->renderView(
            $viewTemplate,
            $data
        );
    }
}
