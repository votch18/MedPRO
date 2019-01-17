<?php

class ProductsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Product();
    }

    public function index(){
        if( $this->getQuery() != null ){
            $this->data['query'] = $this->getQuery();
            $this->data['data'] = $this->model->getProductsByCategory( $this->getQuery() );
        }else{
            $this->data['data'] = $this->model->getApprovedProducts();
        }       
    }

  
    public function detail(){

        if ( isset($this->params[0]) ) {
            //add visits to track most popular products
            $this->model->saveVisits($this->params[0]);

            $this->data = $this->model->getProductById($this->params[0]);
        }
       
    }


    /** Start Admin Pages */
    public function admin_index(){
        $this->data = $this->model->getProducts();
    }

    /** End Admin Pages */

    /**My account pages */
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
    /**End my account pages */

    /**My account & guest ajax */
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
    /**End my account & guest ajax */

    /**Admin ajax */
    public function ajax_approve_product(){
        if(isset($_POST)){       
            $this->model->approveProduct( $_POST['prodid'] );    
            
            //get product details
            $product = $this->model->getProductById( $_POST['prodid'] );
            $message = 'Your product: '.$product['name'].' has been approved.';
            
            $data = array(
                'custid' => $product['custid'],
                'message' => $message
            );

            //add notification
            $note = new Notification();
            $note->save($data);

            $this->data =  json_encode( array('message' => 'success') );
        }
    }
    /**End admin ajax */
}
