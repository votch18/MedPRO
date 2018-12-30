<?php

class WishlistsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Wishlist();
    }

    public function index(){
        $this->data = $this->model->getWishlistByCustomerId();
    }

    public function ajax_additem(){
        if(isset($_POST)){       
            $this->model->save( $_POST );       
            $this->data =  json_encode( array('message' => 'success') );
        }
    }

}
