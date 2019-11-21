<?php

require_once PROJECT_REPOSITORY . 'Manager.php';

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("
            SELECT id,
                   title,
                   content,
                   DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr
            FROM posts 
            ORDER BY creation_date DESC
            LIMIT 0, 5
        ");

        $req->execute();

        /* Récupération de toutes les lignes d'un jeu de résultats */
        return $req->fetchAll();
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("
           SELECT id,
                  title,
                  content,
                  DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr 
           FROM posts 
           WHERE id = ?"
        );

        $req->execute([$postId]);
        $post = $req->fetch();

        return $post;
    }
}
