<?php

namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

/**
 * Class FormAuthenticationValidator
 * @package App\Controller
 */
class FormAuthenticationValidator extends FormValidatorAbstract
{
    /**
     * @return array|mixed[]
     */
    public function getFormFields(): array
    {
        return [
            'login',
            'password'
        ];
    }

    /**
     * @return string
     */
    public function getFormName(): string
    {
        return 'formAuthentication';
    }
}
