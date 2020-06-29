<?php

namespace Core\DefaultAbstract;

use Core\Request;

abstract class FormValidatorAbstract
{
    protected $formFields           = []; // list des champs du formulaire
    protected $submittedValues      = []; // tableau content toutes les valeurs soumises dans la requete http
    protected $formValues           = []; // tableau content les champs et valeur du formulaire
    protected $formFieldsToValidate = []; // list des champs obligatoires

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

    abstract function getFormFields(): array;

    public function getFormFieldToValidate(): array
    {
        return $this->getformFields();
    }

    abstract function getFormName(): string;

    public function getFieldValue($key, $defaultValue = null)
    {
        return $this->formValues[$key] ?? $defaultValue;
    }

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

    public function getFormValues(): array
    {
        return $this->formValues;
    }

    public function isSubmitted(): bool
    {
        return null !== Request::getInstance()->getParam($this->getFormName());
    }
}
