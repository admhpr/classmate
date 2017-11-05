<?php
abstract class Controller{
	protected $_action;
	protected $_request;
	// creates the action and request
	public function __construct ($action, $request){
		$this->_action = $action;
		$this->_request = $request;
	}

	// returns the action method of that model
	public function executeAction(){
		return $this->{$this->_action}();
	}

	protected function returnView($viewmodel, $fullview){
		$view = 'views/'. get_class($this). '/' . $this->_action. '.php';
		// this is the main layout that wraps around the views
		if($fullview){
			require('views/main.php');
		} else {
			require($view);
		}
	}
}