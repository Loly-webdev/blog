<?php

require_once PROJECT_CORE . 'DefaultController.php';
require_once PROJECT_MODEL . 'ArticleManager.php';

class ArticleController extends DefaultController
{
    public function indexAction()
    {
        try {
            //a voir comment recup les id
            $id =null;

            $post = ArticleManager::findById($id);

            if (empty($post[''])) {
                throw new Exception('La page que vous recherchez n\'existe pas');
            }

            $commentList = CommentManager::findComments($post['id']);
            $this->renderView(
                'post.html.twig',
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
