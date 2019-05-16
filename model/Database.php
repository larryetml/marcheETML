<?php

class Database{

    protected $db;

    function __construct() {

        $this->db = $this->connectDatabase();
    }

    public function connectDatabase()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_marcheetml";

        try {
                $database = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Désactiver les simulations des déclarations -> permet de prévenir les injections SQLs
                $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                // echo "Connected successfully"; 
                return ($database);            
            }
        catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
    }

    /* Pour les requêtes sans retour (INSERT, UPDATE, DELETE)*/
    public function executeOnly($query)
    {
        try{
            
            $statement = $this->db->prepare($query);
            $statement->execute();
            // $db->lastInsertId();
            $statement = null;
            
        }catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    /* Pour les requêtes avec plusieurs résultats */
    public function fetchAllAssoc($query)
    {   
        try{
            $statement = $this->db->prepare($query);
            $statement->execute();
            $result = $statement->fetchall(PDO::FETCH_ASSOC);
            $statement = null;
            return $result;
        }catch(Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /* Pour les requêtes avec un seul résultat */
    public function fetchSingle($query)
    {
        try{
            $db = $this->connectDatabase();
            
            $statement = $this->db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $statement = null;
            return $result;

        }catch(Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}

?>