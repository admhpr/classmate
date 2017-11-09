<?php
class UserModel extends Model{
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = password_hash($post['password'], PASSWORD_BCRYPT);
		$salt = md5( rand(0,1000) );

		if($post['submit']){
			if($post['first_name'] == '' || $post['last_name'] == '' || $post['email'] == '' || $post['password'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			// Insert into MySQL
			$this->query('INSERT INTO users (first_name,last_name, email,salt,password) VALUES(:first_name, :last_name,:email,:salt, :password)');
			$this->bind(':first_name', $post['first_name']);
			$this->bind(':last_name', $post['last_name']);
			$this->bind(':email', $post['email']);
			$this->bind(':salt', $salt);
			$this->bind(':password', $password);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'users/login');
			}else{
				echo "There was an error inserting the data";
			}


		}
		return;
	}


	public function login(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$password = password_hash($post['password'], PASSWORD_BCRYPT);
		$salt = md5( rand(0,1000) );

		if($post['submit']){
			// Compare Login
			$this->query('SELECT * FROM users WHERE email = :email');
			$this->bind(':email', $post['email']);
			$row = $this->single();
			//VAR DUMP
			var_dump($row);
			if(password_verify($post['password'], $row['password']) ){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['id'],
					"first_name"	=> $row['first_name'],
					"last_name"	=> $row['last_name'],
					"email"	=> $row['email']
				);
				header('Location: '.ROOT_URL.'app');
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
	//TODO
	public function profile(){
		if($_SESSION['is_logged_in']){
			
		}
	}
}