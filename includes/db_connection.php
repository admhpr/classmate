<?php
class Db{
  // using the singleton pattern we initially set the instance to null 
  private static $link = null;
  private static $dsn;
  private static $username;
  private static $password;

  //build the singleton
  private function __construct($file = 'config.ini'){
      $file = __DIR__ . '/' . $file;
      
      if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
      

      $dsn = $settings['db']['driver'] .
        '/host=' . $settings['db']['host'] .
        ((!empty($settings['db']['port'])) ? (';port=' . $settings['db']['port']) : '') .
        ';dbname=' . $settings['db']['schema'];
   }
    
    // private function __clone(){};

    public static function getInstance(){
        // notes on ::
        // The Scope Resolution Operator (also called Paamayim Nekudotayim) or in simpler terms, the double colon, 
        //is a token that allows access to static, constant, and overridden properties or methods of a class.


        if(!isset(self::$link)){
            // note that this is a dev configuration and will throw exceptions at us ( which is good during development)
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$link = new PDO(self::$dsn, "root", '', $pdo_options);
      }
        return self::$link;
    }

}

?>