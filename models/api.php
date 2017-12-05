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

        public function vote(){
       

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
        
                    // //Redirect
                    // header('Location: '.ROOT_URL.'questions/'.$post['question_id']);
                    
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
                    return true;
                    break;

            }

        }

        public function delete(){
            
        }
    }