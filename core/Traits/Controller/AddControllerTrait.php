<?php

namespace Core\Traits\Controller;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\DefaultAbstract\DefaultAbstractRepository;

/**
 * Trait InsertControllerTrait
 * @package Core\Traits
 */
trait AddControllerTrait
{
    /**
     * Insert action of controller
     */
    public function addAction(): void
    {
        $params = $this->getAddParam();

        $this->addEntity(...$params);
    }

    /**
     * Get Params of addAction
     * @return array
     */
    abstract public function getAddParam(): array;

    /**
     * Method to add entity
     *
     * @param string                    $post
     * @param DefaultAbstractEntity     $entity
     * @param DefaultAbstractRepository $repository
     * @param string                    $viewTemplate
     */
    protected function addEntity(
        string $post,
        DefaultAbstractEntity $entity,
        DefaultAbstractRepository $repository,
        string $viewTemplate
    ): void
    {
        $data    = $this->getRequest()
                        ->getParam($post);
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
