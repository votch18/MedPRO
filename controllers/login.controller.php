<?php

class LoginController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Auth();
    }

    public function index(){
        if ($_POST){
            if ($this->model->loginAccount($_POST['username'], $_POST['password'], $_POST['remember']) ){
                Router::redirect('/');
            }else{
                Session::setFlash("Invalid username or password!");
            }
        }
    }

    public function admin_index(){

        if (Session::get('username') != null || Session::get('username') != ""){
            Router::redirect('/admin/');
        }

        if ($_POST && isset ( $_POST['username']) && isset ($_POST['password'])){
            if ( $this->model->loginAdmin($_POST['username'], $_POST['password'], $_POST['remember']) ){
                Router::redirect('/admin/');
            } else {
                Session::setFlash("Invalid username or password!");
            }
        }
    }
}
