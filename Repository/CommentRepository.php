<?php

require_once PROJECT_REPOSITORY . 'DefaultAbstractRepository.php';

/**
 * Make the database requests relative to the comments
 */
class CommentRepository extends DefaultAbstractRepository
{
    static $tableName = 'comments';
    static $tablePk = 'post_id';
    static $tableOrder = 'comment_date';

    /**
     * This function find all comments in an article
     * @param $articleId
     * @return array
     * @throws Exception
     */
    public function findByArticleId(int $articleId)
    {
        $req = $this->getPDO()->prepare('
            SELECT * 
            FROM ' . static::$tableName . ' 
            WHERE ' . static::$tablePk . ' = ?
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');
        $req->execute(array($articleId));

        return $req->fetchAll();
    }

    public function AddComment($data)
    {
        //je prepare la commande sql qui permet d'inserer dans la table les valeurs d'un article
        //je fais correspondre les colonnes de la table avec les futur valeurs
        //j'execute la commande en affectant dans un tableau des valeurs aux colonnes de la table
        //pour post_id on recupere la valeur de l'article dont on veut faire un commentaire
        //pour les autres valeurs on les recupere du formulaire
        //on lance ensuite la requete complete pour ajouter le commentaire a la base de donnees

        $sql = $this->getPDO()->prepare('
            INSERT INTO ' . static::$tableName . '
            (post_id, author, comment)
            VALUES (:post_id, :author, :comment)');

        var_dump($data);
        $sql->execute(
            ['post_id' => (int)$_GET['articleId'],
            'author' => $data['author'],
            'comment' => $data['comment']]
        );

        $sql = $this->getPDO()->query('SELECT* FROM ' . static::$tableName);
        $sql->fetchAll();
    }
}
