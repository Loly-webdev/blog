<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractRepository;
use LogicException;

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
}
