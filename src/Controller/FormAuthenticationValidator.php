<?php

namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

class FormAuthenticationValidator extends FormValidatorAbstract
{
    public function getFormFields(): array
    {
        return [
            'login',
            'password'
        ];
    }

    public function getFormName(): string
    {
        return 'formAuthentication';
    }
}
