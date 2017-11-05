<?php
class Home extends Controller{
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function error(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->error(), true);
	}
}