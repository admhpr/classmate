<?php
// including the configuration
$config = include(__DIR__.'/config.inc.php');

class Db{
    // using the singleton pattern we initially set the instance to null 
    private static $link = null;

//     //instance vars
//     protected $db_name;
//     protected $host;
//     protected $username;
//     protected $password;
//     protected $dev_build;

//   //build the singleton
//   private function __construct($config){
//     $this->$db_name = $config['db_name'];
//     $this->$host = $config['host'];
//     $this->$username = $config['username'];
//     $this->$password = $config['password'];
//     $this->$dev_build = $config['dev_build'];
//    }
   

    // private function __clone(){};

    public static function getInstance(){
        // notes on ::
        // The Scope Resolution Operator (also called Paamayim Nekudotayim) or in simpler terms, the double colon, 
        //is a token that allows access to static, constant, and overridden properties or methods of a class.

        if(!isset(self::$link)){
            // note that this is a dev configuration and will throw exceptions at us ( which is good during development)
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$link = new PDO('mysql:host=localhost;dbname=final_project', 'root', '', $pdo_options);
      }
        return self::$link;
    }

}

?>