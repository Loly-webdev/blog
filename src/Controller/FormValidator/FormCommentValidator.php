<?php

namespace App\Controller\FormValidator;

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
    public function getFormFields(): array
    {
        return [
            'author',
            'content'
        ];
    }

    /**
     * @return string
     */
    public function getFormName(): string
    {
        return 'comment';
    }
}
