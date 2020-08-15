<?php

namespace App\Controller\FormValidator;

use Core\DefaultAbstract\FormValidatorAbstract;

/**
 * Class FormContactValidator
 * @package App\Controller
 */
class FormContactValidator extends FormValidatorAbstract
{

    /**
     * @return array|mixed[]
     */
    function getFormFields(): array
    {
        return [
            'nameUser',
            'email',
            'subject',
            'message'
        ];
    }

    /**
     * @return string
     */
    function getFormName(): string
    {
        return 'contact';
    }
}
