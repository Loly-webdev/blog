<?php


namespace App\Controller;

use Core\DefaultAbstract\FormValidatorAbstract;

class FormArticleValidator extends FormValidatorAbstract
{

    function getFormFields(): array
    {
        return [
            'title',
            'author',
            'hat',
            'content'
        ];
    }

    function getFormName(): string
    {
        return 'formArticle';
    }
}