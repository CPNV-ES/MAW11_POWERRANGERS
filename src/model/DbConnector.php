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
     * @param string $query
     * @return false|array
     */

    public function query(string $template, array $params = []): false|array
    {
        $sth = $this->db->prepare($template);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    public function queryReturnId(string $template, array $params = []): int
    {
        $sth = $this->db->prepare($template);
        $sth->execute($params);
        return $this->db->lastInsertId();
    }
}

