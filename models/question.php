<?php
class QuestionModel extends Model{
	public function Index(){
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

	public function view(){
		$sql = 'SELECT q.id, q.title, q.content, q.date_created FROM `questions` q
				WHERE id = :id
				JOIN `answers` a ON 
				q.id = a.question_id';
				
		$this->query($sql);
		$this->bind(':id', $_GET['id']);
		$row = $this->all();
		var_dump($row);
		return;
	}
}