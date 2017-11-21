<?php
    class ApiModel extends Model{
        public function get_all($thing){
            $sql = 'SELECT * FROM ' . $thing;
            $this->query($sql);
            $rows = $this->all();
            return json_encode($rows);
        }

        public function vote($id){
       

        }
        
        public function addAnswer($id){
            var_dump($json);

            // $this->query('INSERT INTO answers (user_id, question_id, content, title, total_upvotes, has_voted, is_active)
            //              VALUES(:user_id, :question_id, :content, :title, :total_upvotes, :has_voted, :is_active)')
        }

        public function delete(){
            
        }
    }