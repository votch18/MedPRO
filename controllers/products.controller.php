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
                Router::redirect('/products/');
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
}
