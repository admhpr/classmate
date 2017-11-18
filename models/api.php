<?php
    class ApiModel extends Model{
        public function get_all($thing){
            $sql = 'SELECT * FROM ' . $thing;
            $this->query($sql);
            $rows = $this->all();
            return json_encode($rows);
        }

        public function upvote(){

        }

        public function delete(){
            
        }
    }