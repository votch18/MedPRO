<?php

class OrdersController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Order();
    }

    public function index(){
        $this->data = $this->model->getOrders();
    }

    public function myaccount_index(){
        $this->data = $this->model->getProductsByCustomer();
    }

    public function myaccount_add(){
        if ( $_POST ){           
            if($this->model->save($_POST)) {                
                Router::redirect('/me/products/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function myaccount_edit(){

        $this->data = $this->model->getProductById($this->params[0]);

        if ( $_POST ){           
            if($this->model->save($_POST, $_POST['id'])) {                
                Router::redirect('/me/products/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

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
            $data = $this->model->getOrderCountByCustomer();       
            $this->data =  json_encode( array('message' => $data['count']) );
        }
    }
}
