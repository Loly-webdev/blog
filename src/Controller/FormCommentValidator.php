<?php

namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

/**
 * Class FormCommentValidator
 * @package App\Controller
 */
class FormCommentValidator extends FormValidatorAbstract
{

    /**
     * @return array|string[]
     */
    function getFormFields(): array
    {
        return [
            'author',
            'content'
        ];
    }

    /**
     * @return string
     */
    function getFormName(): string
    {
        return 'comment';
    }
}