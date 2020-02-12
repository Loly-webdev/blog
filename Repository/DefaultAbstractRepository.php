<?php

require_once PROJECT_CORE . 'DefaultPDO.php';

abstract class DefaultAbstractRepository extends DefaultPDO
{
    private $pdo;

    final public function __construct()
    {
        $this->pdo = DefaultPDO::PDOConnect();

        if (!isset(static::$tableName)) {
            throw new Exception('vous devez déclarez le nom de la table pour la classe ' . __CLASS__);
        }

        if (!isset(static::$tablePk)) {
            throw new Exception('vous devez déclarez la clé primaire de la table pour la classe ' . __CLASS__);
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
     * This function find all the informations contained in the table
     * @param array $filters
     * @return array
     * @throws Exception
     */
    public function search(array $filters)
    {
        $sql = 'SELECT *
        FROM ' . static::$tableName . '
        WHERE 1 = 1';

        // chain
        foreach ($filters as $key => $value) {
            $sql .= ' AND ' . $key . ' = ? ';
        }

        // PDO execute
        $pdo = $this->getPDO()
            ->prepare($sql);
        $pdo->execute(array_values($filters));

        return $pdo->fetch();
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
    public function deleteById($id)
    {
        $sql = $this->getPDO()->prepare('
            DELETE
            FROM ' . static::$tableName . '
            WHERE id = ?
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
            WHERE id = ?
            ');

        $sql->execute(array($id));

        // The number of updated entries is displayed.
        $count = $sql->rowCount();
        print('Mise à jour de ' .$count. ' entrée(s)');
    }

    public function selectColumns(array $columns = [])
    {
        $sql = $this->getPDO()->prepare('
            SELECT DISTINCT ' . implode(', ', $columns) . ' 
            FROM '. static::$tableName
        );

        $sql-> execute();

        return $sql->fetchAll();
    }
}
