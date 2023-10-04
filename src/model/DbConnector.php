<?php

namespace model\class;

use PDO;

/**
 * Class DbConnector
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
        public function Query(string $query) : false|array
        {
            //execute query to database
             return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
        }
}