<?php

class PaymentsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Payment();
    }
    public function admin_index(){
        $this->data['data'] = $this->model->getPayments();
	}
	
	public function print_index(){
        Config::set('orientation', 'landscape');
		$this->data['data'] = $this->model->getPayments();
    }

    public function print_receipt(){
        $id = $this->params[0];
		$this->data = $this->model->getPaymentById($id);
    }

	 public function admin_new(){

        $this->data = $this->model->getPayableByPeriod( $this->params[0] );
        
        if($_POST){
			if($this->model->save($_POST)){
               Router::redirect('/admin/loans/schedule/'.$_POST['loan_id'].'/'.$_POST['member_id'].'/');
			} else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }
	
	 public function admin_delete(){
		 if ( isset($this->params[0])){
			  $result = $this->model->delete($this->params[0]);

			  if ( $result ){
				  Router::redirect('/admin/payments/');
			  }else{
				  Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
			  }

		 }
	}
	

    public function admin_schedule(){
	
	
			$loan = new Loan();
		
			$this->data['member_id'] = $this->params[0];
			$this->data['data'] = $loan->getLoanSchedule($this->params[0]);
		
       
    }


    public function ajax_calculate(){

        if(isset($this->params[0])){
                                   
            $data = array(
                'loan_id' => $this->params[0],
                'member_id' => $this->params[1],
                'dop' => $this->params[2],
            );
            
            $this->data =  $this->model->getFullPaymentAmount( $data );
        }
    }

   

    
    
}
