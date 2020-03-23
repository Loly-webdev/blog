<?php

namespace Core\Traits;

use Core\DefaultAbstractEntity;
use Core\DefaultAbstractRepository;

trait InsertControllerTrait
{
    public function insertAction(): void
    {
        $params = $this->getInsertParam();

        $this->insertEntity(...$params);
    }

    abstract public function getInsertParam(): array;

    protected function insertEntity(
        string $post,
        DefaultAbstractEntity $entity,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $data    = $this->getRequest()->getParam($post);
        $message = '';

        if (isset($data)) {
            $object = $entity->hydrate($data);
            $object->hasId();

            if ($post === 'comment') {
                $entity->setPost($_GET['articleId']);
            }

            if ($object->hasId() === false) {
                $articleRepository = $repository;
                $inserted          = $articleRepository->insert($object);
                $message           = $inserted
                    ? "Votre $post à bien était enregistré !"
                    : "Une erreur est survenue.";
            }
        }

        $this->renderView(
            $viewTemplate,
            [
                'message' => $message
            ]
        );
    }
}
