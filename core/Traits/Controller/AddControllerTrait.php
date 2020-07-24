<?php

namespace Core\Traits\Controller;

use App\Service\Message;
use Core\DefaultAbstract\{DefaultAbstractEntity, DefaultAbstractRepository, FormValidatorAbstract};
use LogicException;

/**
 * Trait AddControllerTrait
 * @package Core\Traits\Controller
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
     * @param FormValidatorAbstract $formValidator
     * @param string $entityLabel
     * @param DefaultAbstractEntity $entityClass
     * @param DefaultAbstractRepository $repository
     * @param string $viewTemplate
     */
    protected function addEntity(
        FormValidatorAbstract$formValidator,
        string $entityLabel,
        DefaultAbstractEntity $entityClass,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $formSubmitted = $formValidator;
        if ($formSubmitted->isSubmitted() && $formSubmitted->isValid()) {
            $formSubmitted = $formSubmitted->getFormValues();
            $entity = $entityClass->hydrate($formSubmitted);
            $this->checkForm($entityClass);
            $status = static::statusMessage($repository, $entity, $entityLabel);
        }
        $this->renderView(
            $viewTemplate,
            [
                'status' => $status['status'] ?? '',
                'statusMessage' => $status['statusMessage'] ?? ''
            ]
        );
    }

    /**
     * @param $entity
     */
    public function checkForm($entity)
    {
        if (method_exists($this, 'postHydrate')) {
            $this->postHydrate($entity);
        }

        if ($entity->hasId()) {
            throw new LogicException("L'id ne devrait pas exister.");
        }
    }

    /**
     * @param $repository
     * @param $entity
     * @param string $entityLabel
     * @return array
     */
    static public function statusMessage($repository, $entity, string $entityLabel): array
    {
        return Message::getMessage(
            $repository->insert($entity),
            "Votre $entityLabel à bien était enregistré !",
            'Désolé, une erreur est survenue. Si l\'erreur persiste veuillez prendre contact avec l\'administrateur.'
        );
    }
}
