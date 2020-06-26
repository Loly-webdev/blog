<?php

namespace Core\DefaultAbstract;

use Core\Request;

abstract class FormValidatorAbstract
{
    protected $formFields = []; // list des champs du formulaire
    protected $submittedValues = []; // tableau content toutes les valeurs soumises dans la requete http
    protected $formValues = []; // tableau content les champs et valeur du formulaire
    protected $formFieldsToValidate = []; // list des champs obligatoires

    /**
     * FormValidatorAbstract constructor.
     */
    public function __construct()
    {
        $this->formFields = $this->getFormFields();
        $this->formFieldsToValidate = $this->getFormFieldToValidate();
        $this->submittedValues = Request::getInstance()->getParam($this->getFormName());

        $formValues = [];
        foreach ($this->formFields as $field) {
            $formValues[$field] = $this->submittedValues;
        }

        $this->formValues = $formValues;
    }

    abstract function getFormFields(): array;

    abstract function getFormName(): string;

    public function getFormValues(): array
    {
        return $this->formValues;
    }

    public function getSubmittedValues(): array
    {
        return $this->submittedValues;
    }

    public function getFieldValue($key, $defaultValue = null)
    {
        return $this->formValues[$key] ?? $defaultValue;
    }

    public function getFormFieldToValidate(): array
    {
        // return array_keys($this->getFormFieldToValidate());
        return array_keys($this->formFieldsToValidate);
    }

    public function isValid(): bool
    {
        foreach ($this->getFormFieldToValidate() as $values) {
            if (empty($values)) {
                $isValid = false;
                break;
            }
        }
        return $isValid ?? true;
    }

    public function isSubmitted(): bool
    {
        return null !== Request::getInstance()->getParam($this->getFormName());
    }
}
