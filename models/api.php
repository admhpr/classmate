<?php
    class ApiModel extends Model{
        public function get_all($thing){
            // not the users table return everything
            if($thing != "users"){
                $sql = 'SELECT * FROM ' . $thing;
                $this->query($sql);
                $rows = $this->all();
                return json_encode($rows);
            }else{
                // not returning passwords for obvious reasons
                $sql = 'SELECT id, first_name, last_name, email FROM ' . $thing;
                $this->query($sql);
                $rows = $this->all();
                return json_encode($rows);
            }
        }

        public function extra($id){
            $sql = 'SELECT * FROM users u
					LEFT JOIN `answers` a 
					ON u.id = a.user_id
					LEFT JOIN `questions`q
					ON u.id = q.user_id
					LEFT JOIN `user_roles`ur
					ON u.id = ur.user_id
                    WHERE u.id = :id';

                $this->query($sql);
                $this->bind(":id", $id);
                
                $rows = $this->all();
                return json_encode($rows);
        }
        public function vote(){

            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->query("REPLACE INTO `answer_votes`(`ans_id`, `user_vote_id`, `rating`, `has_voted`) VALUES (:ans_id,:user_vote_id,2, :has_voted)");   
            $this->bind(':ans_id', $post['ans_id']);
            $this->bind(':user_vote_id', $post['user_vote_id']);
            $this->bind(':has_voted', 1);
            $this->execute();

            // Second Query
            $this->query("UPDATE `answers` SET `total_votes` =  :total_votes WHERE id = :id");   
            $this->bind(':id', $post['ans_id']);
            $this->bind(':total_votes', $post['total_votes']);
            $this->execute();

                $status = array(
                    "result" => "success"
                );

            return json_encode($status);
        }
        
        public function add(){
            
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            switch($post['table_name']){
                
                case "answers":
                    $this->query("INSERT INTO `answers` (user_id, question_id, content, is_active) VALUES(:user_id, :question_id, :content, :is_active)");
                    
                    $this->bind(':user_id', $post['user_id']);
                    $this->bind(':question_id', $post['question_id']);
                    $this->bind(':content', $post['answer']);
                    $this->bind(':is_active', 1);
                    $this->execute();
                        
                    $status = array(
                        "result" => "success",
                        "question_id" => $post["question_id"]
                    );
        
                    return json_encode($status);
                    break;

                case "questions":
                    return true;
                    break;
                    
                case "users":
                    $this->query("UPDATE `users` SET `bio` = :bio, `email` = :email, `first_name` = :first_name, `last_name` = :last_name WHERE id = :id ");
                    
                    $this->bind(':bio', $post['bio']);
                    $this->bind(':email', $post['email']);
                    $this->bind(':first_name', $post['first_name']);
                    $this->bind(':last_name', $post['last_name']);
                    $this->bind(':id', $post['user_id']);
                    $this->execute();

                    $status = array(
                        "result" => "success",
                        "question_id" => $post["question_id"]
                    );
        
                    return json_encode($status);
                    break;

            }

        }

        public function delete(){
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           switch($post['table_name']){
                
                case "answers":
                    $sql = "UPDATE answers SET is_active = :is_active WHERE id = :id";  
                    $this->query($sql);   
                    $this->bind(':id', $post['id']);
                    $this->bind(':is_active', 0);
                    $this->execute();
                    $status = array(
                        "result" => "success",
                        "id" => $post["id"]
                    );
        
                    return json_encode($status);
                    break;

                case "questions":
                    $sql = "UPDATE questions SET is_active = :is_active WHERE id = :id";  
                    $this->query($sql);   
                    $this->bind(':id', $post['id']);
                    $this->bind(':is_active', 0);
                    $this->execute();
                    $status = array(
                        "result" => "success",
                        "id" => $post["id"]
                    );
                    return json_encode($status);;
                    break;
                    
                case "users":
                    return true;
                    break;
        }
    }
}