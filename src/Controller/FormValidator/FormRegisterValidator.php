<?php

namespace App\Controller\FormValidator;

use Core\DefaultAbstract\FormValidatorAbstract;

/**
 * Class FormRegisterValidator
 * @package App\Controller
 */
class FormRegisterValidator extends FormValidatorAbstract
{
    /**
     * @return array|string[]
     */
    public function getFormFields(): array
    {
        return [
            'login',
            'mail',
            'password',
            'password2'
        ];
    }

    /**
     * @return string
     */
    public function getFormName(): string
    {
        return 'user';
    }
}
