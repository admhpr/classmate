<?php
class Db{
    // using the singleton pattern we initially set the instance to null 
    private $_connection;
    private static $_instance = null;

    private $_username = "root";
    private $_password = "";
    private $_host = "localhost";
    private $_dbname = "final_project";

    // variables that enable interaction with the Database
    private $dbh;
    private $error;
    private $stmt;

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
        // set Data Source Name
        // https://en.wikipedia.org/wiki/Data_source_name
        $dsn = 'mysql:host='.$this->_host.';dbname='.$this->_dbname;
        // Set Options
		$options = array(
			PDO::ATTR_PERSISTENT		=> true,
			PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION
        );
        // try to connect
        {
            try {
                $this->_connection  = new PDO($dsn, $this->_username, $this->_password, $options);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){
    }
    // Get mysql PDO connection
    public function getConnection(){
        return $this->_connection;
    }

    public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null){
        // if no type is set then check and set one.
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
					default:
					$type = PDO::PARAM_STR;
			}
        }
        // bind the values to the statement
		$this->stmt->bindValue($param, $value, $type);
	}
    // execute the constructed query
	public function execute(){
		return $this->stmt->execute();
	}

	public function lastInsertId(){
		$this->_connection->lastInsertId();
	}

	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>