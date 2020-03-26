<?php

namespace Core\Traits;

use Core\DefaultAbstractRepository;

/**
 * Trait SeeControllerTrait
 * @package Core\Traits
 */
trait SeeControllerTrait
{
    /**
     * See action of controller
     */
    public function seeAction(): void
    {
        $params = $this->getSeeParam();

        $this->seeEntity(...$params);
    }

    /**
     * Get Params of see action
     *
     * @return array
     */
    abstract public function getSeeParam(): array;

    /**
     * Method to see entity
     *
     * @param string                         $entityParamId
     * @param string                         $post
     * @param DefaultAbstractRepository      $repository
     * @param DefaultAbstractRepository|null $repositoryAssociate
     * @param string                         $viewTemplate
     * @param string|null                    $postAssociate
     */
    protected function seeEntity(
        string $entityParamId,
        string $post,
        DefaultAbstractRepository $repository,
        ?DefaultAbstractRepository $repositoryAssociate,
        string $viewTemplate,
        ?string $postAssociate
    ): void
    {
        // Get id to the URL
        $objectId = $this->getRequest()
                         ->getParam($entityParamId);

        if (null === $objectId) {
            throw new \InvalidArgumentException(
                "Désolé, mais la valeur de $post n'est pas renseignée."
            );
        }

        // Load post associate to the Id or return null
        $object = $repository->findOne($objectId);

        if (null === $object) {
            if ($post === 'comment') {
                $objectId = $_GET['articleId'];
            }
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException(
                "Désolé, nous n'avons pas trouvé $post avec l'id: $objectId");
        }

        if ($post === 'article') {
            // Load comments associate to the articleId
            $objectAssociate = $repositoryAssociate->find(['post' => $objectId]);
        }

        $this->renderView(
            $viewTemplate,
            [
                $post          => $object,
                $postAssociate => $objectAssociate ?? null
            ]
        );
    }
}
