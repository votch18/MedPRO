<?php

class FundsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Fund();
    }

    public function admin_index(){
        if( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/funds/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }

        $this->data['data'] = $this->model->getFunds();

    }
}
