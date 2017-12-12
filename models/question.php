<?php
class QuestionModel extends Model{

	public function index(){
		$sql = 'SELECT q.id, q.content, q.title, q.date_created,q.is_active,
				c.category, c.id as cat_id,
				u.first_name, u.last_name, q.user_id 
				FROM `questions` q
				LEFT JOIN `categories` c ON q.category_id = c.id 
				LEFT JOIN `users` u ON q.user_id = u.id
				ORDER BY q.date_created DESC';

		$this->query($sql);
		$rows = $this->all();
		return $rows;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['submit']){
			if($post['title'] == '' || $post['content'] == ''){
				Messages::setMsg('Please fill in all fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('INSERT INTO questions (title, content, category_id,user_id,is_active) VALUES(:title,:content,:category_id,:user_id,:is_active)');
			$this->bind(':title', $post['title']);
			$this->bind(':content', $post['content']);
			$this->bind(':category_id', $post['category_id']);
			$this->bind(':user_id', $_SESSION['user_data']['id']);
			$this->bind(':is_active', 1);
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
		
		$sql = 'SELECT q.id, q.title, q.content, q.date_created,q.user_id as ques_user_id,
				a.id as answer_id, 
				a.title as answer_title,
				a.content as answer_content,
				a.date_created as answer_created, 
				a.user_id,a.total_votes,
				av.ans_id, av.user_vote_id, av.rating, 
				av.has_voted,
				u.first_name, u.last_name,
				c.category,
                ur.role_id,
                r.role
				FROM `questions` q 
				LEFT JOIN `categories` c 
				ON q.category_id = c.id 
				LEFT JOIN `answers` a 
				ON q.id = a.question_id
				LEFT JOIN `answer_votes` av 
				ON a.id = av.ans_id
				LEFT JOIN `users` u 
				ON a.user_id = u.id
				LEFT JOIN `user_roles` ur 
				ON ur.user_id = u.id
				LEFT JOIN `roles` r 
				ON r.id = ur.role_id
				WHERE q.id = :id';

		$id = intval($id);		
		$this->query($sql);
		$this->bind(':id', $id);
		$row = $this->all();

		// if(DEV_BUILD){
		// 	var_dump($row);
		// }
		return $row;
	}
	// depreciated
	public function cat($id){

		$sql = 'SELECT c.id, c.category, q.id, q.title, q.content 
				FROM categories c, questions q 
				WHERE c.id = q.id';


		$this->query($sql);
		$this->bind(':id', $id);
		$row = $this->all();

		if(DEV_BUILD){
			var_dump($row);
		}
		return $row;
	}
}