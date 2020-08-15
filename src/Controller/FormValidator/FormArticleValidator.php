<?php

namespace App\Controller\FormValidator;

use Core\DefaultAbstract\FormValidatorAbstract;

/**
 * Class FormArticleValidator
 * @package App\Controller
 */
class FormArticleValidator extends FormValidatorAbstract
{

    /**
     * @return array|string[]
     */
    function getFormFields(): array
    {
        return [
            'title',
            'author',
            'hat',
            'content'
        ];
    }

    /**
     * @return string
     */
    function getFormName(): string
    {
        return 'article';
    }
}
