<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';


class ArticleController extends DefaultAbstractController
{
    public function indexAction()
    {
        // on recupere l'id dans l'url
        $articleId = $this->getRequest()->getParam('articleId');

        if (null === $articleId) {
            throw new \InvalidArgumentException(
                'Désolé, mais la valeur de l\'article n\'est pas renseignée.'
            );
        }

        // on cherche les données en bdd associees a l'id (null si rien trouve)
        $article = ArticleRepository::findOne($articleId);

        if (null === $article) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            // Ce type d'exceptions doit obligatoirement faire l'objet d'une correction de votre code.
            throw new \LogicException(
                sprintf('Désolé, nous n\'avons pas trouvé l\'article avec l\'id: %d', $articleId)
            );
        }

        // on affiche les commentaires associes
        $comments = CommentRepository::findByArticleId($articleId);

        $this->renderView(
            'article.html.twig',
            [
                'article' => $article,
                'comments' => $comments
            ]
        );
    }
}
