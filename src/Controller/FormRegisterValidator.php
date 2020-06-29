<?php

namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

class FormRegisterValidator extends FormValidatorAbstract
{
    public function getFormFields(): array
    {
        return [
            'login',
            'mail',
            'password',
            'password2'
        ];
    }

    public function getFormName(): string
    {
        return 'user';
    }
}
