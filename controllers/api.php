<?php 

    // We will only need this to add data to the db? We could probably use forms.
    
    class Api extends Controller{
    
        protected function all(){
            $model = new ApiModel();
            $this->returnJson($model->get_all($_GET['model']));
        }
        
        protected function add(){
            $model = new ApiModel();
            $this->returnJson($model->add());
        }

         protected function delete(){
            $model = new ApiModel();
            $this->returnJson($model->delete());
        }

        

        // protected function get_many(){
        //     $req = new ApiModel();
        //     var_dump($req);
        // }
        // protected function get_one(){
        //     $req = new API();
        // }
        // protected function post_many(){
        //     $req = new API();
        // }
        // protected function post_one(){
        //    $req = new API(); 
        // }
        // protected function put(){
        //     $req = new API();
        // }
       
    }