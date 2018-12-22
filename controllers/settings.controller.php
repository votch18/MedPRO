<?php

class SettingsController extends Controller{

    public function __construct($data = array()){
        parent::__construct($data);
        $this->model = new Setting();
    }
    public function admin_index(){
         $this->data['data'] = $this->model->getSettings();

        if ( $_POST ){
            if($this->model->save($_POST)){
                Router::redirect('/admin/settings/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_carousel(){
        $carousel = new Carousel();
        $this->data['data'] = $carousel->getCarousels();
    }

    public function admin_carousel_new(){
        $carousel = new Carousel();
        if ( $_POST ){
            if($carousel->save($_POST)){
                Router::redirect('/admin/settings/carousel/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_carousel_change_image(){
        $carousel = new Carousel();
        $this->data['data'] = $this->params[0];
        if ( $_POST ){
            if($carousel->change_image($_POST['id'])){
                Router::redirect('/admin/settings/carousel/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_carousel_edit(){
        $carousel = new Carousel();
        $this->data = $carousel->getCarouselById($this->params[0]);

        if ( $_POST ){
            if($carousel->save($_POST, $_POST['id'])){
                Router::redirect('/admin/settings/carousel/');
            } else {
                Session::setFlash("<strong>Oh Snap!</strong> There was an error saving this record!");
            }
        }
    }

    public function admin_carousel_delete(){
        $carousel = new Carousel();
        if ( isset($this->params[0])){
            $result = $carousel->delete($this->params[0]);

            if ( $result ){
                Router::redirect('/admin/settings/carousel/');
            }else{
                Session::setFlash("<strong>Oh Snap!</strong> This was an error deleting this record!");
            }

        }
    }
}
