<?php
class Questions extends Controller{
	protected function index(){
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->index(), true);
	}

	protected function add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'questions');
		}
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->add(), true);
	}

	protected function find(){
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->find($_GET["id"]), true);
	}

	protected function category(){
		$viewmodel = new QuestionModel();
		$this->returnView($viewmodel->cat($_GET["id"]), true);
	}

}