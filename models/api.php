<?php
    class ApiModel extends Model{
        public function get_all($thing){
            $sql = 'SELECT * FROM ' . $thing;
            $this->query($sql);
            $rows = $this->all();
            return json_encode($rows);
        }

        public function vote(){
       

        }
        
        public function add(){
            
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $this->query("INSERT INTO `answers` (user_id, question_id, content, is_active) VALUES(:user_id, :question_id, :content, :is_active)");
            
            $this->bind(':user_id', $post['user_id']);
            $this->bind(':question_id', $post['question_id']);
            $this->bind(':content', $post['answer']);
            $this->bind(':is_active', 1);
            $this->execute();

            // //Redirect
            // header('Location: '.ROOT_URL.'questions/'.$post['question_id']);
            
            $status = array(
                "msg" => "success",
                "question_id" => $post["question_id"]
            );

            return json_encode($status);

        }

        public function delete(){
            
        }
    }