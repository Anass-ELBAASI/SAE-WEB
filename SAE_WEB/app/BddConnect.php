<?php

namespace Romai\SaeWeb;

use Romai\SaeWeb\Exceptions\BddConnectException;
use Romai\SaeWeb;

class BddConnect {
    public \PDO $pdo;
    protected string $host;
    protected string $login;
    protected string $password;
    protected string $dbname;

    public function __construct() {
        $this->host="localhost:3307";
        $this->login="root";
        $this->password="";
        $this->dbname="sae_web_database";
    }

    /**
     * @throws BddConnectException
     */
    public function connexion() : \PDO {
        try {

            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
            $this->pdo = new \PDO($dsn, $this->login, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch(\PDOException $e) {
            throw new BddConnectException("Erreur de connexion BDD : il faut configurer la classe BDDConnect avec les bonnes valeurs");
        }

        return $this->pdo;
    }
}