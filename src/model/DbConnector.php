<?php

namespace model\class;

use PDO;

/**
 * Class DbConnector
 *
 * @package model\class
 */
class DbConnector
{
    //attributes
    private string $dbHost;
    private string $dbName;
    private string $dbUser;
    private string $dbPass;
    private PDO $db;

    //constructor
    public function __construct(string $dbHost, string $dbName, string $dbUser, string $dbPass)
    {
        //set attributes
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;

        //connect to database
        $this->db = new PDO(
            "mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8",
            $this->dbUser,
            $this->dbPass
        );
    }

    /**
     * Prepare and execute a query
     *
     * @param string $request requests to execute without values
     * @param array $values values of the insertion default value []
     * @return false|array
     */
    public function query(string $request, array $values = []): false|array
    {
        $sth = $this->db->prepare($request);
        $sth->execute($values);
        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Prepare, execute a query and return the id value
     *
     * @param string $request requests to execute without values
     * @param array $values values of the insertion default value []
     * @return int value of the query return
     */
    public function queryReturnId(string $request, array $values = []): int
    {
        $sth = $this->db->prepare($request);
        $sth->execute($values);
        return $this->db->lastInsertId();
    }
}

