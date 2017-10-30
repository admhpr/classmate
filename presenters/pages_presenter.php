<?php
  class PagePresenter {
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