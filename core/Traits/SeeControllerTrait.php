<?php

namespace Core\Traits;

use Core\DefaultAbstractRepository;

trait SeeControllerTrait
{
    protected function seeEntity(
        string $entityParamId,
        string $post,
        DefaultAbstractRepository $repository,
        ?DefaultAbstractRepository $repositoryAssociate,
        string $viewTemplate,
        ?string $postAssociate
    ): void {
        // Get id to the URL
        $objectId = $this->getRequest()->getParam($entityParamId);

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
                $post  => $object,
                $postAssociate => $objectAssociate ?? null
            ]
        );
    }

    public function seeAction(): void
    {
        $params = $this->getSeeParam();

        $this->seeEntity(...$params);
    }

    abstract public function getSeeParam(): array;
}
