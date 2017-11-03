<?php
  class PagePresenter {
    public function login(){
      require_once('views/pages/login.php');
    }
    public function home() {
      $first_name = 'TEST';
      $last_name  = 'PERSON';
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>