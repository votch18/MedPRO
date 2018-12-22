<?php

class LoansController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Loan();
    }

    public function admin_index(){
        if( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/loans/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> This!");
            }
        }

        $this->data['data'] = $this->model->getLoans();

    }

    public function admin_pending(){
        if( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/loans/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> This!");
            }
        }

        $this->data['data'] = $this->model->getPendingLoans();

    }


    public function admin_search(){
        if($_POST){
            $this->data['data'] = $this->model->searchLoans($_POST['search']);
        }else{
            $this->data['data'] = array();
        }
    }

    public function admin_new(){
		if ( $_GET ){
           $this->data['member_id'] = $_GET['id'];
		   $member = new Member();
		   $borrower = $member->getMemberById($_GET['id']);
		   $this->data['name'] = $borrower['name'];
        }else{
			$this->data['member_id'] = null;
			 $this->data['name'] = null;
		}
		
        if ( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/loans/deductions/'.$_POST['loan_id']);
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_edit(){
		if ( $this->params[0] ){
           $this->data['member_id'] = $_GET['id'];
		   $member = new Member();
		   $borrower = $member->getMemberById($_GET['id']);
		   $this->data['name'] = $borrower['name'];
        }else{
			$this->data['member_id'] = null;
			 $this->data['name'] = null;
		}
		
        if ( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/loans/deductions/'.$_POST['loan_id']);
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_schedule(){
        $this->data['member_id'] = $this->params[1];
        $this->data['loan_id'] = $this->params[0];
            
		if($_POST){
			$payment = new Payment();
			
			if($payment->save($_POST)){
               Router::redirect('/admin/loans/schedule/'.$this->params[0].'/'.$this->params[1]);
			} else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
		}
		
    }
	
	
	public function admin_summary(){
		
        $this->data['member_id'] = $this->params[1];
        $this->data['loan_id'] = $this->params[0];
	
		
    }

    public function admin_application(){
        $member = new Member();
        $this->data = $member->getMemberById($this->params[0]);

        if ( $_POST ){
            if($this->model->save($_POST)){
               Router::redirect('/admin/loans/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }
	
	public function admin_deductions(){
		if ( isset($this->params[0])){
			$this->data = $this->model->getLoansById($this->params[0]);
			
			if($_POST){
				$result = $this->model->saveDeductions($_POST);
				$updateLoan = $this->model->updateLoan($_POST);
				
				if ( $result ){
					Router::redirect('/admin/loans/summary/'.$_POST['loan_id'].'/'.$_POST['member_id']);
				}else{
					Session::setFlash("<strong>Oh Snap!</strong> This was an error saving this record!");
				}
			}
		}else {
			 Router::redirect('/admin/loans/');
		}
	}
	 
	 public function admin_delete(){
        if ( isset($this->params[0])){
            $result = $this->model->delete($this->params[0]);

            if ( $result ){
                Router::redirect('/admin/loans/');
            }else{
                Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
            }

        }
    }

    public function print_index(){
        $this->data['data'] = $this->model->getLoans();

    }

    public function ajax_index(){

        $member = new Member();
        if($this->getQuery()!=null){
            $this->data =$member->searchMembers($this->getQuery());
            
        }
    }

}
