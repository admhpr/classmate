<?php
class Questions extends Controller{
	protected function Index(){
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'questions');
		}
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function view(){
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->view(), true);
	}
}