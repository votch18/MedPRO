<?php

class MembersController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Member();
    }
    public function admin_index(){
         if( $_POST ){
             if($this->model->save($_POST)){
                 Router::redirect('/admin/members/');
             } else {
                 Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
             }
         }

         $this->data['data'] = $this->model->getMembers();

    }

    public function admin_deleted(){
       
        $this->data['data'] = $this->model->getDeletedMembers();

   }

    public function admin_search_result(){

         if ( $_POST ){
              $this->data['data'] = $this->model->searchSubscribers($_POST['q']);
              $this->data['query'] = $_POST['q'];
         }
    }

    public function admin_new(){
          if ( $_POST ){
               if($this->model->save($_POST)){
                   Router::redirect('/admin/members/');
               } else {
                   Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
               }
          }
    }

    public function admin_edit(){
       $this->data = $this->model->getMemberDataById($this->params[0]);

       if ( $_POST ){
           if($this->model->save($_POST, $_POST['id'])){
               Router::redirect('/admin/members/');
           } else {
               Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
           }
       }
   }

   public function admin_delete(){
     if ( isset($this->params[0])){
          $result = $this->model->delete($this->params[0]);

          if ( $result ){
              Router::redirect('/admin/members/');
          }else{
              Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
          }

     }
 }

 public function admin_deactivate(){
     if ( isset($this->params[0])){
          $result = $this->model->deactivate($this->params[0]);

          if ( $result ){
              Router::redirect('/admin/members/');
          }else{
              Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
          }

     }
 }

public function admin_activate(){
    if ( isset($this->params[0])){
         $result = $this->model->activate($this->params[0]);

         if ( $result ){
            Router::redirect('/admin/members/deleted/');
         }else{
            Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
         }

    }
}

public function admin_upgrade(){
     $this->data = $this->model->getSubscriberById($this->params[0]);

     if ( $_POST ){
         if($this->model->upgrade($_POST, $_POST['id'])){
             Router::redirect('/admin/members/');
         } else {
             Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
         }
     }

}

public function print_index(){

         $this->data['data'] = $this->model->getMembers();

    }


}