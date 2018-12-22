<?php

class Page_not_foundController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = null;
    }

    public function index(){
         $this->model = null;
    }
}
