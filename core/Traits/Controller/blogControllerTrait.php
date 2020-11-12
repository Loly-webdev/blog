<?php

namespace Core\Traits\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Core\DefaultAbstract\DefaultAbstractEntity;
use Exception;

trait blogControllerTrait
{
    public static $entityLabel = "article";

    /**
     * Give params to seeAction
     * @return array|mixed[]
     * @throws Exception
     */
    public function getSeeParam(): array
    {
        return [
            'articleId',
            'article',
            new ArticleRepository(),
            'article/articleById.html.twig',
        ];
    }

    /**
     * @param array|mixed[]         $data
     * @param DefaultAbstractEntity $entity
     *
     * @return array|mixed[]
     */
    public function preRenderView(array $data, DefaultAbstractEntity $entity): array
    {
        // Load comments associate to the articleId
        $comments = (new CommentRepository())->search(
            [
                'approved'  => 'oui',
                'articleId' => $entity->getId()
            ]
        );

        $data['comments'] = $comments;

        return $data;
    }
}
