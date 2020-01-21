<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'CommentRepository.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';


class ArticleController extends DefaultAbstractController
{
    public function indexAction()
    {
        try {

            $id = $_GET['id'];
            $article = ArticleRepository::findById($id);

            if (!empty($article[''])) {
                throw new Exception('La page que vous recherchez n\'existe pas');
            }

            //$comments = CommentRepository::findArticleComments($id);
            //var_dump($comments);

            $this->renderView(
                'article.html.twig',
                [
                    'article' => $article,
                    //'comments' => $comments
                ]
            );

        } catch (Throwable $t) {

            require_once PROJECT_CONTROLLER . 'ErrorController.php';
            $error = new ErrorController();
            $error->error($t);
        }
    }
}
