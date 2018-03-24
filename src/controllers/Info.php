<?php
class Info extends Controller{
	
	protected function privacy(){
		$viewmodel = new InfoModel();
		$this->returnView($viewmodel->privacy(), true);
	}
}