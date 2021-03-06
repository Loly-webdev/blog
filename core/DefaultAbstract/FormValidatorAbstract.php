<?php

namespace Core\DefaultAbstract;

use Core\Request;
use Core\Session;

/**
 * Class FormValidatorAbstract
 * @package Core\DefaultAbstract
 */
abstract class FormValidatorAbstract
{
    // List of form fields
    protected $formFields = [];
    // Table containing all the values submitted in the http request
    protected $submittedValues = [];
    // Table contains the fields and values of the form
    protected $formValues = [];
    // List of required fields
    protected $formFieldsToValidate = [];
    // List of errors
    protected $formErrors = [];

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
            // If the form field exists in Request and a value other than null and empty is filled in,
            // then we hydrate the form field.
            if (isset($this->submittedValues[$field]) && '' !== $this->submittedValues[$field]) {
                $formValues[$field] = $this->submittedValues[$field];
            }
        }

        $this->formValues = $formValues;
    }

    /**
     * @return array
     */
    abstract public function getFormFields(): array;

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
    abstract public function getFormName(): string;

    /**
     * @param      $key
     * @param null $defaultValue
     *
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

        $tokenValid = Session::isValidToken($this->getFormName());
        if (false === $tokenValid) {
            $this->addError('token', 'Une erreur s\'est produite, merci de rafraichir la page.');
            $isValid = false;
        }

        // We go through the required fields
        foreach ($fieldsToValidate as $fieldToValidate) {
            // If the required field is empty or null in the form 'populated' then we stop
            if ((false === isset($formValues[$fieldToValidate])) || ('' === $formValues[$fieldToValidate])) {
                $this->addError($fieldToValidate, "Une erreur s'est produite sur le champ $fieldToValidate, merci de rafraîchir la page.");
                $isValid = false;
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
     * @param string $fieldNameInvalid
     * @param string $errorMessage
     */
    public function addError(string $fieldNameInvalid, string $errorMessage): void
    {
        $this->formErrors[$fieldNameInvalid] = $errorMessage;
    }

    /**
     * @return string|null
     */
    public function getMessageErrors(): ?string
    {
        return $this->getErrors()
            ? implode(" ", $this->getErrors()) . "\n"
            : null;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->formErrors;
    }

    /**
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return null !== Request::getInstance()->getParam($this->getFormName());
    }
}
