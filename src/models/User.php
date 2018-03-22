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

				// Insert into MySQL DB

				$this->query("INSERT INTO users (first_name,last_name,email,salt,password,is_active) VALUES(:first_name,:last_name,:email,:salt,:pass,:is_active)");
				$this->bind(':first_name', $post['first_name']);
				$this->bind(':last_name', $post['last_name']);
				$this->bind(':email', $post['email']);
				$this->bind(':salt', $salt);
				$this->bind(':pass', $password);
				$this->bind(':is_active', 1);
				$this->execute();

				// new query

				$this->query('INSERT INTO user_roles (role_id,is_active) VALUES(:role_id, 1)');
				$this->bind(':role_id', $post['role_id']);
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
			$sql = 'SELECT u.id, u.first_name, u.last_name, u.email, 
					u.image_path, u.bio, u.password, u.salt,
					ur.role_id, r.role
					FROM users u
					LEFT JOIN `user_roles` ur 
					ON ur.user_id = u.id
					LEFT JOIN `roles` r 
					ON r.id = ur.role_id
					WHERE email = :email';

			// Compare Login
			$this->query($sql);
			$this->bind(':email', $post['email']);
			$row = $this->single();
			
			if(password_verify($post['password'], $row['password']) ){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"id"	=> $row['id'],
					"first_name"	=> $row['first_name'],
					"last_name"	=> $row['last_name'],
					"email"	=> $row['email'],
					"role_id" => $row['role_id'],
					"role" => $row['role']
				);

				Messages::setMsg('Successful login!', 'success');
				sleep(2);
				header('Location: '.ROOT_URL.'users/profile/'.$_SESSION['user_data']['id']);
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
	
	public function profile($id){

		if($_SESSION['is_logged_in']){
			
			$sql = 'SELECT * FROM users u
					LEFT JOIN `answers` a 
					ON u.id = a.user_id
					LEFT JOIN `questions`q
					ON u.id = q.user_id
					LEFT JOIN `user_roles`ur
					ON u.id = ur.user_id
					WHERE u.id = :id';

			$id = intval($id);		
			$this->query($sql);
			$this->bind(':id', $id);
			$row = $this->single();
			$row['bio'] = htmlspecialchars_decode($row['bio'], ENT_QUOTES);
			return $row;
		}else{
			return false;
		}
	}	
	public function upload(){
	  
		if(isset($_FILES['avatar'])){
			$response = array(
				"result" => "",
				"message" => "",
				"image_path" => ""
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
				
				$dest = $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."user-images/".$_SESSION['user_data']['id'].$file_name;
				$image_url = ROOT_URL."user-images/" . $_SESSION['user_data']['id'].$file_name;
				$image_dir_url = $_SERVER['DOCUMENT_ROOT'].ROOT_PATH."user-images/";
				
				if(!file_exists($image_dir_url)){
					umask(0);
					mkdir($image_dir_url);
					chmod($image_dir_url, 0777);
				}

				if(move_uploaded_file($file_tmp,$dest)){
					
					$id = $_SESSION['user_data']['id'];
					$sql = "UPDATE `users` SET image_path = :image_path  WHERE id = :id";
					$id = intval($id);
					$this->query($sql);
					$this->bind(':id', $id);
					$this->bind(':image_path', $image_url);
					$this->execute();
					$response['result'] = "success";
					$response['message'] = $file_name." has been successfully uploaded"; 
					$response['image_path'] = $image_url;
				};

			}else{
				$response['result'] = "error";
				$response['message'] = $errors[0]; 
			}
		}
		
		return json_encode($response);
	}
}