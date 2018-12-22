<?php

class ReportsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Room();
    }
    public function admin_index(){

        $page = empty($this->query[1]) ?  1 : $this->query[1];
        $this->data['data'] = $this->model->getRoomInventory($page);
        $this->data['page'] = $page;
    }

    public function admin_room_inventory(){
        if ( $_POST ){
            $this->data['data'] = $this->model->getRoomIncome($_POST);
            $this->data['msg'] = 'Results - From: '.$_POST['from'].' - '.$_POST['to'];

        }else {
            $this->data['data'] = $this->model->getRoomIncome();
            $this->data['msg'] = null;
        }

        Session::set('report', $this->data['data']);
      
    }

    public function admin_cottage_inventory(){

        $cottage = new Cottage();

        if ( $_POST ){
            $this->data['data'] = $cottage->getCottageIncome($_POST);
            $this->data['msg'] = 'Results - From: '.$_POST['from'].' - '.$_POST['to'];

        }else {
            $this->data['data'] = $cottage->getCottageIncome();
            $this->data['msg'] = null;
        }

        Session::set('report', $this->data['data']);

    }

    public function admin_rides(){

        $ride = new Ride();
        $this->data['data'] = $ride->getRides();

        Session::set('report', $this->data['data']);

    }

    public function admin_functionhall_inventory(){

        $cottage = new Cottage();

        if ( $_POST ){
            $this->data['data'] = $cottage->getFunctionHallIncome($_POST);
            $this->data['msg'] = 'Results - From: '.$_POST['from'].' - '.$_POST['to'];

        }else {
            $this->data['data'] = $cottage->getFunctionHallIncome();
            $this->data['msg'] = null;
        }

        Session::set('report', $this->data['data']);
    }

    public function admin_income(){

        $payment = new Payment();
        if ( $_POST ){
            $this->data['data'] = $payment->getPaymentsByPeriod($_POST);
            $this->data['msg'] = 'Results - From: '.$_POST['from'].' - '.$_POST['to'];

        }else {
            $this->data['data'] = $payment->getPayments();
            $this->data['msg'] = null;
        }

        Session::set('report', $this->data['data']);
    }
	
	public function admin_cashier(){

        $payment = new Payment();
        if ( $_POST ){
            $this->data['data'] = $payment->getPaymentsByCashierByPeriod($_POST);
            $this->data['msg'] = 'Results - From: '.$_POST['from'].' - '.$_POST['to'];

        }else {
            $this->data['data'] = $payment->getPaymentsByCashier();
            $this->data['msg'] = null;
        }

        Session::set('report', $this->data['data']);
    }

    public function admin_checkin_reports(){
        $checkin = new Checkin();
        $checkins = $checkin->getCheckinReports();

        $page = empty($this->query[1]) ?  1 : $this->query[1];
        $this->data['data'] = $checkins;
        $this->data['page'] = $page;

    }


    public function print_room_inventory(){

        $this->data['data'] = Session::get('report');
       
    }

    public function print_income(){

        $this->data['data'] = Session::get('report');
       
    }

    public function print_cashier(){

        $this->data['data'] = Session::get('report');
       
    }

    public function print_rides(){

        $this->data['data'] = Session::get('report');
       
    }

    public function print_cottage_inventory(){

        $this->data['data'] = Session::get('report');
       
    }

    public function print_functionhall_inventory(){

        $this->data['data'] = Session::get('report');
       
    }
}
