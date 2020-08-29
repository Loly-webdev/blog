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
    public function getFormFields(): array
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
    public function getFormName(): string
    {
        return 'article';
    }
}
