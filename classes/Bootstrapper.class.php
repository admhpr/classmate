
<?php
/**
 * Bootstrapping refers to the process of loading the environment a program (or a script, in the case of PHP)
 * needs to operate. In the context of PHP development, it also means funneling all web requests through 
 * a single script that performs the bootstrapping process, also called "front controller."
 */
class Bootstrapper{
	//our controller, action and handling the requests
	private $controller;
	private $action;
	private $request;

	/* builds the request and sets defaults
	   uses the variables from the $_GET requests
	   when class is instantiated

	   The $_GET looks like this
	   index.php?controller=$1&action=$2&id=$3
	*/
	public function __construct($request){
		// sets the request
		$this->request = $request;
		// sets the controller as app if none is supplied
		// see .htaccess
		// $1 capture group one 
		if($this->request['controller'] == ""){
			$this->controller = 'app';
		} else {
			$this->controller = $this->request['controller'];
		}
		// sets action to index if none is supplied
		// $2 capture group two
		if($this->request['action'] == ""){
			$this->action = 'index';
		} else {
			$this->action = $this->request['action'];
		}
	}
	// This is the base of all the controllers
	// displays errors when DEV_BUILD is set to true found in config.php
	public function createController(){
		/* Check if class exists
		   (true):instantiate
		   (false):do not load and display errors 

			// Check if the controller class exists
				(true): check if the action exists as a method of the controller
				(false):display errors 
						 
						
				// Check if method exists
					(true): return a the controller with action passed to it and instantiate
					(false):display errors 
						 
		*/
		if(class_exists($this->controller)){
			$parents = class_parents($this->controller);
			if(in_array("Controller", $parents)){
				if(method_exists($this->controller, $this->action)){
					return new $this->controller($this->action, $this->request);
				} else {

					if(DEV_BUILD){
					 	trigger_error("ERROR:", E_ALL);
						 // Method Does Not Exist
						 echo '<h1>Method does not exist: create one in '. $this->controller . ' controller </h1>';
						 return;
					}
				}
			} else {

				if(DEV_BUILD){
					trigger_error("ERROR:", E_ALL);
					// Base Controller Does Not Exist
					echo '<h1>Base controller not found create a controller with name ' . $this->controller . '</h1>';
					return;
				}
				
			}
		} else {
			if(DEV_BUILD){
				trigger_error("ERROR:", E_ALL);
				// Controller Class Does Not Exist
				echo '<h1>Base class not found create a class with name of ' . $this->request['controller'] . '. make sure the files are required on the index page</h1>';
				return;
			}
		}
	}
}