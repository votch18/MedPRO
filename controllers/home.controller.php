<?php

class HomeController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = null;
    }
    public function index(){

    }

    public function admin_index(){
        $user = new User();
        $this->data = $user->getByUserId(Session::get('userid'));;

        if ( $_POST ){
            if($user->change_picture($_POST, $_POST['id'])){
                Router::redirect('/admin/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }
}