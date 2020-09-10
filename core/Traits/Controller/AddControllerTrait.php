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
     * @param FormValidatorAbstract     $formValidator
     * @param DefaultAbstractEntity     $entity
     * @param DefaultAbstractRepository $repository
     * @param string                    $viewTemplate
     */
    protected function addEntity(
        FormValidatorAbstract $formValidator,
        DefaultAbstractEntity $entity,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $formErrors = $formValidator->isSubmitted() && $formValidator->isValid()
            ? $formValidator->getErrors()
            : [];

            $data = [
                'status'        => '',
                'StatusMessage' => '',
                'formErrors'    => $formErrors
            ];

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {
            $formValidator = $formValidator->getFormValues();
            $entity->hydrate($formValidator);

            $this->preSave($entity);
            $saved = $this->save($repository, $entity);
            $data = static::prepareMessage($saved);
            $this->postSave($entity);
        }

        if (method_exists($this, 'preRenderView')) {
            $data = $this->preRenderView($data, $entity);
        }

        $this->renderView(
            $viewTemplate,
            $data
        );
    }

    /**
     * @param DefaultAbstractRepository $repository
     * @param DefaultAbstractEntity     $entity
     *
     * @return bool
     */
    final public function save(
        DefaultAbstractRepository $repository,
        DefaultAbstractEntity $entity
    ): bool
    {
        return $repository->insert($entity);
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function preSave($entity): void
    {
        if (method_exists($this, 'postHydrate')) {
            $this->postHydrate($entity);
        }

        if ($entity->hasId()) {
            throw new LogicException('L\'id ne devrait pas exister.');
        }
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function postSave($entity):void
    {
    }

    /**
     * @param $saved
     *
     * @return array
     */
    public static function prepareMessage($saved): array
    {
        return Message::getMessage(
            $saved,
            'Votre ' . static::$entityLabel . ' à bien était enregistré !',
            'Désolé, une erreur est survenue. Si l\'erreur persiste veuillez prendre contact avec l\'administrateur.'
        );
    }

    /**
     * Methods for sending information or approval emails.
     *
     * @param $entity
     *
     * @return void
     */
    public function mailFunction($entity): void
    {
        if (method_exists($this, 'mailApproved')) {
            $this->mailApproved();
        }

        if (method_exists($this, 'mailInfo')) {
            $this->mailInfo($entity);
        }
    }
}
