<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Trait InsertControllerTrait
 * @package Core\Traits
 */
trait AddControllerTrait
{
    /**
     * Insert action of controller
     */
    public function addAction(): void
    {
        $params = $this->getAddParam();

        $this->addEntity(...$params);
    }

    /**
     * Get Params of addAction
     * @return array
     */
    abstract public function getAddParam(): array;

    /**
     * Method to add entity
     *
     * @param string                    $entityName
     * @param DefaultAbstractEntity     $entityClass
     * @param DefaultAbstractRepository $repository
     * @param string                    $viewTemplate
     */
    protected function addEntity(
        string $entityName,
        DefaultAbstractEntity $entityClass,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $data    = $this->getRequest()->getParam($entityName);
        $message = '';

        if (isset($data)) {
            $entity = $entityClass->hydrate($data);
            $entity->hasId();

            if (method_exists($this, 'dependencyId')) {
                $this->dependencyId($entityClass);
            }

            if ($entity->hasId() === false) {
                $articleRepository = $repository;
                $inserted          = $articleRepository->insert($entity);
                $message           = $inserted
                    ? "Votre $entityName à bien était enregistré !"
                    : "Une erreur est survenue.";
            }
        }

        $this->renderView(
            $viewTemplate,
            [
                'message' => $message
            ]
        );
    }
}
