<?php
    class SystemPresenter{
        public function login(){
         require_once('views/system/login.php');
        }

        public function register(){
            require_once('views/system/register.php');
        }
        public function logout(){
            require_once('views/system/logout.php');
        }
        public function forgot(){
            require_once('views/system/forgot.php');
        }
    }
?>