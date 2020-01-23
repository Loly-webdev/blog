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
            throw new \InvalidArgumentException('La valeur de l\'article soumise n\'est pas valide.');
        }

        // on cherche les données en bdd associees a l'id (null si rien trouve)
        $article = ArticleRepository::findById($articleId);

        if (null === $article) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            // Ce type d'exceptions doit obligatoirement faire l'objet d'une correction de votre code.
            throw new \LogicException('La page que vous recherchez n\'existe pas');
        }

        // on affiche les commentaires associes
        $comments = CommentRepository::findArticleComments($articleId);

        $this->renderView(
            'article.html.twig',
            [
                'article' => $article,
                'comments' => $comments
            ]
        );
    }
}
