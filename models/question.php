<?php
class QuestionModel extends Model{

	public function index(){
		$sql = 'SELECT q.id, q.title, q.content, q.date_created, a.id as answer_id FROM `questions` q
				LEFT JOIN `answers` a ON q.id = a.question_id
				GROUP BY q.title
				';
		$this->query($sql);
		$rows = $this->all();
		return $rows;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		if($post['submit']){
			if($post['title'] == '' || $post['content'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('INSERT INTO questions (title, content, user_id) VALUES(:title, :content,:user_id)');
			$this->bind(':title', $post['title']);
			$this->bind(':content', $post['content']);
			// $this->bind(':link', $post['link']);
			$this->bind(':user_id', $_SESSION['user_data']['id']);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'questions');
			}
		}
		return;
	}

	public function find($id){
		
		$sql = 'SELECT q.id, q.title, q.content, q.date_created, 
				a.id as answer_id, a.title as answer_title, a.content as answer_content
				FROM `questions` q 
				LEFT JOIN `answers` a 
				ON q.id = a.question_id
				WHERE q.id = :id';

		$id = intval($id);		
		$this->query($sql);
		$this->bind(':id', $id);
		$row = $this->all();

		if(DEV_BUILD){
			var_dump($row);
		}
		return $row;
	}


}