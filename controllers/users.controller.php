<?php

class UsersController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new User();
    }


    public function admin_login(){

        if (Session::get('username') != null || Session::get('username') != ""){
            Router::redirect('/admin/');
        }

        if ($_POST && isset ( $_POST['username']) && isset ($_POST['password'])){
            $user = $this->model->getByUserName($_POST['username']);
            $hash = md5($user['asin'].$_POST['password']);

            if ($user && $user['is_active'] && $hash == $user['password']){
                //get access pages
                $pages = explode("/", $user['access_pages']);

                Session::set("pages", $pages);
                Session::set('userid', $user['userid']);
                Session::set('username', $user['username']);
                Session::set('access', $user['access']);

                Router::redirect('/admin/');
            }else {
                Session::setFlash("Invalid username or password!");
            }
        }
    }

    public function admin_index(){
        $this->data = $this->model->getUsers();
    }

    public function admin_edit(){
        $this->data = $this->model->getByUserId($this->params[0]);

        if ( $_POST ){
            if($this->model->save($_POST, $_POST['id'])){
                Router::redirect('/admin/users/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_add(){
        if ( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/users/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_delete(){
        if ( isset($this->params[0])){
            $result = $this->model->deleteUser($this->params[0]);

            if ( $result ){
                Router::redirect('/admin/users/');
            }else{
                Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this users!");
            }
        }
    }

    public function admin_change_password(){
        $this->data = $this->model->getByUserId(Session::get('userid'));

        if ( $_POST ){
            if($this->model->change_password($_POST, $_POST['id'])){
				if(Session::get('access') == "2"){
					Router::redirect('/admin/users/change_password/');
				}else{
					Router::redirect('/admin/users/');
				}
                
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function u_change_password(){
        $customer = new Customer();

        $this->data = $customer->getCustomerById(Session::get('userid'));

        if ( $_POST ){
            if($customer->customer_change_password($_POST, $_POST['id'])){
                Router::redirect('/u/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

   
    public function logout(){
        $auth = new Auth();
        $auth->logout();
        
        Router::redirect('/');
    }

    public function admin_logout(){
        $auth = new Auth();
        $auth->logout();
        
        Router::redirect('/admin/');
    }
}
