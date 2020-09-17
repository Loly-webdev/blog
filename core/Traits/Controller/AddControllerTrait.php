<?php

namespace Core\Traits\Controller;

use App\Service\Message;
use Core\Session;
use Core\DefaultAbstract\{DefaultAbstractEntity, DefaultAbstractRepository, FormValidatorAbstract};
use Exception;
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
     *
     * @throws Exception
     */
    protected function addEntity(
        FormValidatorAbstract $formValidator,
        DefaultAbstractEntity $entity,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $formErrors = $formValidator->isSubmitted() && $formValidator->isValid(static::$key)
            ? $formValidator->getErrors()
            : [];

        $token = Session::generateToken(static::$key);

        $data = [
            'status'        => '',
            'StatusMessage' => '',
            'tokenValue'    => $token,
            'formErrors'    => $formErrors
        ];

        if ($formValidator->isSubmitted() && $formValidator->isValid(static::$key)) {
            $formValues = $formValidator->getFormValues();
            $entity->hydrate($formValues);

            $this->preSave($formValues, $entity);
            $saved = $this->save($repository, $entity);
            $data  = static::prepareMessage($saved);
            $this->postSave($saved, $entity);
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
     * @param array|null $formValues
     * @param            $entity
     *
     * @return void
     */
    public function preSave(?array $formValues, $entity): void
    {
        if (method_exists($this, 'postHydrate')) {
            $this->postHydrate($entity);
        }

        if ($entity->hasId()) {
            throw new LogicException('L\'id ne devrait pas exister.');
        }
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
     * @param $saved
     * @param $entity
     *
     * @return void
     */
    public function postSave($saved, $entity): void
    {
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
