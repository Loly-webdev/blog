<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'ArticleRepository.php';

class ArticleController extends DefaultAbstractController
{
    public function indexAction()
    {
        try {
            $post = ArticleRepository::findById($id);

            if (empty($post[''])) {
                throw new Exception('La page que vous recherchez n\'existe pas');
            }

            $commentList = CommentRepository::findById($id);
            $this->renderView(
                'article.html.twig',
                [
                    'post' => $post,
                    'commentList' => $commentList,
                ]
            );

        } catch (Throwable $t) {

            require_once PROJECT_CONTROLLER . 'ErrorController.php';
            $error = new ErrorController();
            $error->error($t);
        }
    }
}
