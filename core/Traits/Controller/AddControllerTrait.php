<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\{DefaultAbstractEntity, DefaultAbstractRepository};
use LogicException;

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
     * @param string                    $entityLabel
     * @param string                    $entityName
     * @param DefaultAbstractEntity     $entityClass
     * @param DefaultAbstractRepository $repository
     * @param string                    $viewTemplate
     */
    protected function addEntity(
        string $entityLabel,
        string $entityName,
        DefaultAbstractEntity $entityClass,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $formSubmitted = $this->getRequest()->getParam($entityName);
        if (isset($formSubmitted)) {

            if (false === is_array($formSubmitted)) {
                throw new LogicException('Un formulaire doit être passer en tableau.');
            }

            $entity = $entityClass->hydrate($formSubmitted);

            if (method_exists($this, 'postHydrate')) {
                $this->postHydrate($entity);
            }

            if ($entity->hasId()) {
                throw new LogicException("L'id ne devrait pas exister.");
            }

            $status  = "danger";
            $message = "Désolé, une erreur est survenue. Si l'erreur persiste veuillez prendre contact avec l'administrateur.";

            if ($repository->insert($entity)) {
                $status  = "success";
                $message = "Votre $entityLabel à bien était enregistré !";
            }
        }

        $this->renderView(
            $viewTemplate,
            [
                'status'  => $status ?? '',
                'message' => $message ?? ''
            ]
        );
    }
}
