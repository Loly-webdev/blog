<?php

namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

class FormContactValidator extends FormValidatorAbstract
{

    function getFormFields(): array
    {
        return [
            'nameUser',
            'email',
            'subject',
            'message'
        ];
    }

    function getFormName(): string
    {
        return 'contact';
    }
}
