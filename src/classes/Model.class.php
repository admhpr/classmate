<?php
abstract class Model{
	protected $dbh;
	protected $stmt;

	public function __construct(){
		/* This is our database handler which is constructed every time we use an instance of our model
		   this means that our SQL statements are prepared and handled securely everytime
	    */
		$this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		if(DEV_BUILD){
			$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}
	}

	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	//Binds the prep statement
	public function bind($param, $value, $type = null){
 		if (is_null($type)) {
  			switch (true) {
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
		$this->stmt->bindParam($param, $value, $type);
	}

	public function execute(){
		$this->stmt->execute();
	}

	public function all(){

		$this->execute();
		$data = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		$html_enitity_decoded_data = array();
		

		foreach( $data as $row ){
			$row['title'] = htmlspecialchars_decode($row['title'], ENT_QUOTES);
			$row['content'] = htmlspecialchars_decode($row['content'], ENT_QUOTES);
			array_push($html_enitity_decoded_data, $row);
		}

		return $html_enitity_decoded_data;
	}

	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
}