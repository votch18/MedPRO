<?php

class ExpensesController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Expenditure();
    }
    public function index(){
        Router::redirect('/admin/login/');
    }

    public function admin_index(){
       $this->data['data'] = $this->model->getExpenditures();
    }



}
