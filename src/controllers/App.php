<?php
class App extends Controller{
	
	protected function index(){
		$viewmodel = new AppModel();
		$this->returnView($viewmodel->Index(), true);
	}
// this is the action that is executed 
	protected function error(){
		$viewmodel = new AppModel();
		$this->returnView($viewmodel->error(), true);
	}
}