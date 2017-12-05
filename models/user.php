<?php
class UserModel extends Model{
	// Dev Notes: refer to ~/classes/Model.class.php to see the available MySQL methods
	public function index(){
		$sql = 'SELECT u.first_name, u.last_name, u.bio  FROM `users` u';
		$this->query($sql);
		$rows = $this->all();
		return $rows;
	}

	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = password_hash($post['password'], PASSWORD_BCRYPT);
		$salt = md5( uniqid(rand(0,1000)) );

		// Set password min length
		if(DEV_BUILD){
			$pw_len = 2;
		}else{
			$pw_len = 7;
		}

		// Check POST type
		if($post['submit']){
			if(strlen($post['password']) > $pw_len){
				if($post['first_name'] == '' || $post['last_name'] == '' || $post['email'] == '' || $post['password'] == ''){
					Messages::setMsg('Please fill in all fields', 'error');
					return;
				}
	
				if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
					Messages::setMsg('Please Enter a valid email', 'error');
					return;
				}
				
				$this->query("SELECT * FROM `users`  WHERE `email` = :email");
				$this->bind(':email', $post['email']);
			
				if(count($this->all()) > 0){
					Messages::setMsg('Looks like that email has already been taken..', 'error');
					return;
				}

				// Insert into MySQL
				$this->query('INSERT INTO users (first_name,last_name, email,salt,password,is_active) VALUES(:first_name, :last_name,:email,:salt, :password,1)');
				$this->bind(':first_name', $post['first_name']);
				$this->bind(':last_name', $post['last_name']);
				$this->bind(':email', $post['email']);
				$this->bind(':salt', $salt);
				$this->bind(':password', $password);
				$this->execute();
				// Verify
				if($this->lastInsertId()){

					if(SEND_LINK){
						Messages::setMsg("Thank you please check your email for confirmation", 'success');

						//send email to who?
						$to = $post['email'];

						//email subject
						$subject = 'Your confirmation link here';

						//From
						$headers = 'From: the-team@classmate.com' . "\\r" .
									'Reply-To: the-team@classmate.com' . "\\r\
									" .'X -Mailer: PHP/' . phpversion();

						$message =  "Please click the link to activate your account \n
								  https://nocteherba.com/users/verify/" . $salt;
						

						//send mail
						//SMTP settings
						ini_set(SMTP,'localhost');
						ini_set(smtp_port,'25');
						ini_set(sendmail_from,'admin@localhost.com');
						$sentmail = mail($to, $subject, $message, $headers);
					}else{	
						
						//Redirect
						header('Location: '.ROOT_URL.'users/login');
					}
					
				}else{
					Messages::setMsg('There was an error inserting the data sorry ¯\_(ツ)_/¯', 'error');	
				}
			} else {
			  Messages::setMsg('Password must be at least 8 letters in length!', 'error');	
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

			// Using password verify on Blowfish algo
			if(password_verify($post['password'], $row['password']) ){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['id'],
					"first_name"	=> $row['first_name'],
					"last_name"	=> $row['last_name'],
					"email"	=> $row['email']
				);
				Messages::setMsg('Successful login', 'success');
				header('Location: '.ROOT_URL.'users/profile'.$_SESSION['user_data']['id']);
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
	
	public function profile($id){

		if($_SESSION['is_logged_in']){
			$sql = 'SELECT * FROM users
					WHERE id = :id';

			$id = intval($id);		
			$this->query($sql);
			$this->bind(':id', $id);
			$row = $this->single();
			return $row;
		}
	}	
	public function upload(){
	  
		if(isset($_FILES['avatar'])){
			$response = array(
				"result" => "",
				"message" => ""
			);
			$errors= array();
			$file_name = $_FILES['avatar']['name'];
			$file_size =$_FILES['avatar']['size'];
			$file_tmp =$_FILES['avatar']['tmp_name'];
			$file_type=$_FILES['avatar']['type'];
			
			$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			
			if(in_array($file_type,$allowed)=== false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			
			$maxsize = 10 * 1024 * 1024; // calculate MB
			if($file_size > $maxsize){
				$errors[] = "File Size must be no bigger than 10 MB";
			}
			
			if(empty($errors)==true){
				
				$dest = ROOT_URL . "/user-images/".$_SESSION['user_data']['id'].$file_name;
				$imageUrl = ROOT_PATH. "user-images/" . $_SESSION['user_data']['id'].$file_name;
				var_dump($dest);
				var_dump($file_tmp);
				move_uploaded_file($file_tmp,$dest);

				$id = $_SESSION['user_data']['id'];
				$sql = "UPDATE `users` SET image_path = :image_path  WHERE id = :id";
				$id = intval($id);
				$this->query($sql);
				$this->bind(':id', $id);
				$this->bind(':image_path', $imageUrl);
				$this->execute();

				$response['result'] = "success";
				$response['message'] = $file_name." has been successfully uploaded"; 
			}else{
				$response['result'] = "error";
				$response['message'] = $errors[0]; 
			}
		}
		
		return json_encode($response);
	}
}