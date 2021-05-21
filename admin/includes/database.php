<?php 
require_once 'new_config.php';


class Database {
    public $connection;

    function __construct() {
        $this -> open_db_connection();
    }
  
    public function open_db_connection() {

        $this -> connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->connect_errno) {

            die("Error: ". $this->connection->connect_error);
        }
    }

    public function query($sql) {

       return $this->connection->query($sql);
    }

    private function confirm_query($res) {

        die("Query Failed" . $this->connection->connect_error) ?: !$res;
    }

    public function escape_string($string) {

        return $this->connection->real_escape_string($string);

    }

    public function insert_id() {
        return $this->connection->insert_id; 
    }

}


$database = new Database();
