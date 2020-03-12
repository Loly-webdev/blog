<?php

namespace App\Controller;

use App\Entity\Article;
use Core\DefaultAbstractController;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;

class ArticleController extends DefaultAbstractController
{
    protected $key;

    public function indexAction()
    {
        $articles = (new ArticleRepository())->find();
        //pour des listes déroulante
        //$article = (new ArticleRepository())->selectColumns(['title', 'content']);

        $this->renderView(
            'articles.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    public function seeAction()
    {
        // Get id to the URL
        $articleId = $this->getRequest()->getParam('articleId');
var_dump($articleId);

        if (null === $articleId) {
            throw new \InvalidArgumentException(
                'Désolé, mais la valeur de l\'article n\'est pas renseignée.'
            );
        }

        // Load article associate to the articleId or return null
        $article = (new ArticleRepository())->find($articleId);

        if (null === $article) {
            // \LogicException() : Exception qui représente les erreurs dans la logique du programme.
            throw new \LogicException(
                sprintf('Désolé, nous n\'avons pas trouvé l\'article avec l\'id: %d', $articleId)
            );
        }

        // Load comments associate to the articleId
        $comments = (new CommentRepository())->find([
                                                        'post_id' => $articleId
                                                    ]);

        $this->renderView(
            'article.html.twig',
            [
                'article'  => $article,
                'comments' => $comments
            ]
        );
    }

    public function addAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('article');

        if (isset($data['id'])) {
            $article = new Article($data);
            $article->hasId();
            (new ArticleRepository())->add((array)$article);
        }
        $message = ''
            ? "Votre article à bien était enregistré !"
            : "Une erreur est survenue.";

        $this->renderView(
            'articleForm.html.twig',
            [
                'message' => $message
            ]
        );
        /* // Retrieve all data in a table
         $data = $this->getRequest()->getParam('article');

         if (null === $data) {
             $this->renderView(
                 'articleForm.html.twig'
             );
         }

         if (isset($data)) {
             (new ArticleRepository())->add($data);

             $this->renderView(
                 'articleForm.html.twig',
                 [
                     'message' => "Votre article à bien était enregistré !"
                 ]
             );
         }*/
    }

    public function deleteAction()
    {
        (new ArticleRepository())->delete($this->getRequest()->getParam('articleId'));
        $this->renderView(
            'articleForm.html.twig',
            [
                'message' => "Votre article à bien était supprimé !"
            ]
        );
    }

    public function updateAction()
    {
        // todo
    }
}
