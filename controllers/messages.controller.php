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

    
    /** My Account Pages */
    public function myaccount_index(){
        $this->data = $this->model->getMessagesByCustomerId();
    }

    public function myaccount_chat(){
        if ( isset($this->params[0]) ) {
            $this->data['data'] = $this->model->getConversation(Session::get('userid'), $this->params[0]);
            $this->data['sender'] = $this->params[0];
        }else {
            Router::redirect('/me/messages/');
        }
    }

    /** My Account Pages */

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
    public function ajax_get_unread_messages(){             
        $this->data =  json_encode( $this->model->get_unread_messages() );
    }
     
    public function ajax_get_messages(){
        if( isset($_POST) ){           
            $this->data =  json_encode( $this->model->getConversation($_POST['sender'], $_POST['receiver']) );
        }
    }

    public function ajax_read_messages(){             
        $this->data =  json_encode( array( 'result' => $this->model->mark_as_read() ));
    }
    
    public function ajax_send(){             
        $this->data =  json_encode( array( 'result' => $this->model->send($_POST) ));
    }
    /** End Ajax Request */

    /** Ajax request admin */
    public function ajax_get_admin_notifications(){
        $note = new Notification();       
        $this->data =  json_encode( $note->get_admin_notifications() );
    }

     
    public function ajax_read_admin_notifications(){
        $note = new Notification();       
        $this->data =  json_encode( $note->mark_as_read_admin() );
    }

    /** End ajax admin */
}
