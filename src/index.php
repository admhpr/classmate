<?php
// Start session so there is access to the session variables used during login
session_start();

// Includes
require('env.php');
require('config.php');

// third party libs
require_once 'vendor/autoload.php';

if(!DEV_BUILD){
   error_reporting( 0 );
}
/*
  Register all the classes using an anonymous function
  ref: spl_autoload_register 
  returns: boolean
  params: ([ callable $autoload_function [, bool $throw = true [, bool $prepend = false ]]] )
*/
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

require('controllers/App.php');
require('controllers/Api.php');
require('controllers/Questions.php');
require('controllers/Users.php');
require('controllers/Info.php');

require('models/App.php');
require('models/Api.php');
require('models/Question.php');
require('models/User.php');
require('models/Info.php');

// Instantiate the Bootstrapper class and pass in the $_GET request
$front_controller = new Bootstrapper($_GET);
// create the controller, which will default to app
$controller = $front_controller->createController();
// create action which defaults to index
if($controller){
	$controller->executeAction();
}else{
  $_GET['controller'] ='app';
  $_GET['action'] = 'error';
  $error = new Bootstrapper($_GET);
  $controller = $error->createController();
  $controller->executeAction();
}