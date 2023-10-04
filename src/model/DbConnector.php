<?php

namespace model\class;

use PDO;

class DbConnector
{

        private string $dbHost;
        private string $dbName;
        private string $dbUser;
        private string $dbPass;
        private PDO $db;

        public function __construct(string $dbHost, string $dbName, string $dbUser, string $dbPass)
        {
            $this->dbHost = $dbHost;
            $this->dbName = $dbName;
            $this->dbUser = $dbUser;
            $this->dbPass = $dbPass;

            $this->db = new PDO(
                "mysql:host=$this->dbHost;dbname=$this->dbName;charset=utf8",
                $this->dbUser,
                $this->dbPass
            );
        }

        public function Query(string $query) : false|array
        {
             return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
        }
}

//TODO : delete unused
/*
function dbConnector(){


    $dbHost = $_ENV['DATABASE_HOST'];
    $dbName = $_ENV['DATABASE_NAME'];
    $dbUser = $_ENV['DATABASE_USERNAME'];
    $dbPass = $_ENV['DATABASE_PASSWORD'];

    $connexion = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8",
        $dbUser,
        $dbPass
    );

    return $connexion;

}*/

