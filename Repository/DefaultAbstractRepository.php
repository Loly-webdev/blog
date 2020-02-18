<?php

require_once PROJECT_CORE . 'DefaultPDO.php';

abstract class DefaultAbstractRepository extends DefaultPDO
{
    private $pdo;

    public abstract function getEntity();

    final public function __construct()
    {
        $this->pdo = DefaultPDO::PDOConnect();

        if (!isset(static::$tableName)) {
            throw new Exception('vous devez déclarez le nom de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tableOrder)) {
            throw new Exception('vous devez déclarez l\'ordre de tri de la table pour la classe ' . __CLASS__);
        }
    }

    /**
     * Polymorphism method
     * @param null $filters
     * @return mixed
     * @throws Exception
     */
    public function find($filters = null)
    {
        if (is_numeric($filters)) {
            return $this->findOne($filters);
        } elseif (is_array($filters) && !empty($filters)) {
            return $this->search($filters);
        }

        return $this->findAll();
    }

    /**
     * Find all the informations of the table where id is equal to the id find by the getParams method
     * @param $articleId
     * @return mixed
     * @throws Exception
     */
    public function findOne(int $articleId)
    {
        $sql = $this->getPDO()->prepare('SELECT *
            FROM ' . static::$tableName . '
            WHERE ' . static::$tablePk . ' = ? ');

        $sql->execute([$articleId]);

        return $sql->fetch();
    }

    /**
     * This method make the connection to the database and load the DefaultPDO class
     * @throws Exception
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * Allows you to perform an sql query with filters or to retrieve all of them if no filter is found.
     *
     * @param array $filters Contains in key the columns of the table and in value the "equal to".
     *
     * @return array An empty table where the results can be found in bdd
     * @throws Exception
     */
    public function search(array $filters)
    {
        $result = [];

        // SQL REQUEST
        $sql = 'SELECT *
            FROM ' . static::$tableName . '
            WHERE 1 = 1 '; // On précise un where 1 = 1 pour éviter de gérer le WHERE || AND

        // Array of values
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        // PDO execute
        $pdo = $this->getPDO()->prepare($sql);

        var_dump($pdo);
        var_dump($filters);

        // On passe les valeurs à remplacer par les ? de la requete sql
        // Pas besoin de récupérer juste les valeurs la fonction prend pas en compte les clefs
        $pdo->execute($filters);
        var_dump($pdo->execute($filters));

        // On récupere les résultats
        $result = $pdo->fetchAll();
        var_dump($result);

        return $result;
    }

    /**
     * This function find all the informations contained in the table
     * @throws Exception
     */
    public function findAll()
    {
        $sql = $this->getPDO()->query('
            SELECT *
            FROM ' . static::$tableName . '
            ORDER BY ' . static::$tableOrder . ' DESC 
        ');

        $sql->execute();

        return $sql->fetchAll();
    }

    /**
     * Delete the entry with the id find by the getParams method
     * @param $id
     * @return void
     * @throws Exception
     */
    public function delete($id)
    {
        $sql = $this->getPDO()->prepare('
            DELETE FROM ' . static::$tableName . '
            WHERE ' . static::$tablePk . ' = ?
            ');

        $sql->execute(array($id));

        // The number of deleted entries is displayed.
        $count = $sql->rowCount();
        print('Effacement de ' .$count. ' entrées.');
    }

    public function updateById($id){

        $sql = $this->getPDO()->prepare('
            UPDATE ' . static::$tableName . '
            SET title = :title, content = :content
            WHERE ' . static::$tablePk . ' = ?
            ');

        $sql->execute(array($id));

        // The number of updated entries is displayed.
        $count = $sql->rowCount();
        print('Mise à jour de ' .$count. ' entrée(s)');
    }

    public function selectColumns(array $columns = [])
    {
        $sql = $this->getPDO()->prepare('
            SELECT ' . implode(', ', $columns) . ' 
            FROM '. static::$tableName
        );

        $sql-> execute();

        return $sql->fetchAll();
    }
}
