<?php

class LoginController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new User();
    }

    public function index(){
        if ($_POST){
            $account = new Account();
            if ($account->loginAccount($_POST['username'], $_POST['password'])){
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
            $user = $this->model->getByUserName($_POST['username']);
            $hash = md5($user['salt'].$_POST['password']);

            if ($user && $user['is_active'] && $hash == $user['password']){
                Session::set('userid', $user['userid']);
                Session::set('username', $user['username']);
                Session::set('access', $user['access']);
                
                $log = new Log();
                $log->save('Log-in');

                Router::redirect('/admin/');
            }else {
                Session::setFlash("Invalid username or password!");
            }
        }
    }
}
