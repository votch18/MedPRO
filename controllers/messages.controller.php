<?php

class MessagesController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Message();
    }

    /** Admin Pages */
    public function admin_index(){
        $this->data = $this->model->getAdminThread();
    }

    /** End Admin Pages */

    /** Ajax Request */
    public function ajax_removeitem(){        
        if( isset($_POST) ){              
            $this->data =  $this->model->delete( $_POST['id'] );
        }
    }

    public function ajax_additem(){
        if( isset($_POST) ){       
            $this->model->save( $_POST );       
            $this->data =  json_encode( array('qty' => '1') );
        }
    }

    public function ajax_getorders(){
        if( isset($_POST) ){       
            $data = $this->model->getOrderCountByCustomer( $_POST );       
            $this->data =  json_encode( array('message' => $data['count']) );
        }
    }
    /** End Ajax Request */
}
