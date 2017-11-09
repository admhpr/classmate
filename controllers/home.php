<?php
class Home extends Controller{
	
	protected function index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}
// this is the action that is executed 
	protected function error(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->error(), true);
	}
}