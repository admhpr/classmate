<?php
class Db{
  // using the singleton pattern we initially set the instance to null 
    private $_connection;
    private static $_instance;
  // $dsn = data source name
  // https://en.wikipedia.org/wiki/Data_source_name
  private $_username = "root";
  private $_password = "";
  private $_host = "localhost";
    private $_dbname = "final_project";

       /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct(){
        {
            try {
                $this->_connection  = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbname, $this->_username, $this->_password);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){
    }
    // Get mysql pdo connection
    public function getConnection(){
        return $this->_connection;
    }
}

?>