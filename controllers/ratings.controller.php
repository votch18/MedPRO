<?php

class RatingsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Rate();
    }
   
    public function admin_index(){
       $this->data = $this->model->getAdminRatings();
    }


    public function rate(){

        if ( isset( $_POST ) ) {       
            $rating = new Rate();   
            $rating->save( $_POST );
        }

        Router::redirect('/products/detail/'.$this->params[0]);
    }

    public function ajax_delete(){        
        if(isset($_POST)){              
            $this->data =  $this->model->delete( $_POST['id'] );
        }
    }

}
