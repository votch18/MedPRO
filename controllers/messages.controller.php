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

    /** Ajax Request Myaccount*/
   
    public function ajax_getnotifications(){
        if( isset($_POST) ){       
            $note = new Notification();       
            $this->data =  json_encode( $note->getNotificationsByCustomerId($_POST['id']) );
        }
    }

     
    public function ajax_readnotifications(){
        if( isset($_POST) ){       
            $note = new Notification();       
            $this->data =  json_encode( $note->mark_as_read($_POST['id']) );
        }
    }
    /** End Ajax Request */
}
