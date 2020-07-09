<?php

namespace Core\DefaultAbstract;

use Core\Request;

/**
 * Class FormValidatorAbstract
 * @package Core\DefaultAbstract
 */
abstract class FormValidatorAbstract
{
    /**
     * liste des champs du formulaire
     * @var array
     */
    protected $formFields           = [];
    /**
     * tableau content toutes les valeurs soumises dans la requete http
     * @var array|mixed|null
     */
    protected $submittedValues      = [];
    /**
     * tableau content les champs et valeur du formulaire
     * @var array
     */
    protected $formValues           = [];
    /**
     * liste des champs obligatoires
     * @var array
     */
    protected $formFieldsToValidate = [];

    /**
     * FormValidatorAbstract constructor.
     */
    public function __construct()
    {
        $this->formFields           = $this->getFormFields();
        $this->formFieldsToValidate = $this->getFormFieldToValidate();
        $this->submittedValues      = Request::getInstance()->getParam($this->getFormName());

        $formValues = [];
        foreach ($this->formFields as $field) {
            // Si le champs du formulaire existe dans Request et qu'une valeur autre que null et vide est renseigné
            // alors on hydrate le champs du formulaire
            if (isset($this->submittedValues[$field]) && '' !== $this->submittedValues[$field]) {
                $formValues[$field] = $this->submittedValues[$field];
            }
        }

        $this->formValues = $formValues;
    }

    /**
     * @return array
     */
    abstract function getFormFields(): array;

    /**
     * @return array
     */
    public function getFormFieldToValidate(): array
    {
        return $this->getformFields();
    }

    /**
     * @return string
     */
    abstract function getFormName(): string;

    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public function getFieldValue($key, $defaultValue = null)
    {
        return $this->formValues[$key] ?? $defaultValue;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $fieldsToValidate = $this->getFormFieldToValidate();
        $formValues       = $this->getFormValues();

        // On parcours les champs obligatoire
        foreach ($fieldsToValidate as $fieldToValidate) {
            // si le champs obligatoire est vide ou null dans le formulaire 'populé' alors on stop
            if (false === isset($formValues[$fieldToValidate]) || '' === $formValues[$fieldToValidate]) {
                $isValid = false;
                break;
            }
        }
        return $isValid ?? true;
    }

    /**
     * @return array
     */
    public function getFormValues(): array
    {
        return $this->formValues;
    }

    /**
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return null !== Request::getInstance()->getParam($this->getFormName());
    }
}
