<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->$first_name directly
    public $id;
    public $first_name;
    public $last_name;
    public $bio;

    public function __construct($id, $first_name, $last_name, $bio) {
      $this->id      = $id;
      $this->first_name  = $first_name;
      $this->last_name = $last_name;
      $this->bio = $bio;
    }
    //methods used by UserPresenter
    public static function all() {
      $list = [];
      $db = Db::getInstance()->getConnection();
      $req = $db->query('SELECT * FROM users');

      // we create a list of User objects from the database results
      foreach($req->fetchAll() as $user) {
        $list[] = new User($user['id'], $user['first_name'], $user['last_name'],$user['bio']);
      }
      // close connection
      $db = null;
      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance()->getConnection();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM users WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $user = $req->fetch();

      return new User($user['id'], $user['first_name'], $user['last_name'],$user['bio']);
    }
  }
?>