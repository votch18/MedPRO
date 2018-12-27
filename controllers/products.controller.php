<?php

class ProductsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Product();
    }

    public function index(){
        
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

    public function ajax_delete(){
        
        if(isset($_POST)){
              
            $this->data =  $this->model->delete( $_POST['id'] );
        }
    }

    public function ajax_add_photo(){
        
        if(isset($_POST)){
              
            $this->data =  $this->model->addPhoto( $_POST['id'] );
        }
    }

    public function ajax_delete_photo(){
        
        if(isset($_POST)){
              
            $this->data =  $this->model->deletePhoto( $_POST['image'],  $_POST['id']);
        }
    }

    public function ajax_save_main_photo(){
        
        if(isset($_POST)){              
            $this->data =  $this->model->saveMainPhoto( $_POST['image'],  $_POST['id'] );
        }
    }

    public function ajax_addstocks(){
        if(isset($_POST)){       
            $this->model->saveStocks( $_POST );       
            $this->data =  json_encode( array('qty' => $_POST['qty']) );
        }
    }
}
