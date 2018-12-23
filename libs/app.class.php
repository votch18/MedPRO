<?php

class App{

    protected static $router;
    public static $db;

    /**
     * @return mixed
     */
    public static function getRouter(){
        return self::$router;
    }

    public static function run($uri){
        self::$router = new Router($uri);
        self::$db = new DB(Config::get('db_host'),Config::get('db_username'),Config::get('db_password'),Config::get('db_name'));

        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());


        $layout = self::$router->getRoute();
        $access = Session::get('access');

     
        if ($layout == 'admin'){
            if ( !isset($access) && self::$router->getController() != 'login'){
                Router::redirect('/admin/login/');
            }
         
            if ( isset($access) &&
                //!in_array(strtolower(self::$router->getController()), Session::get('pages')) &&
                strtolower(self::$router->getController()) != 'home'){

                if ((self::$router->getController() == 'users') &&
                    ($controller_method == 'admin_account_edit' ||
                        $controller_method == 'admin_change_password')){
                    //do nothing
                }else {
                    Router::redirect('/admin/');
                }

            }
        }



        $controller_object = new $controller_class();
        if (method_exists($controller_object, $controller_method)) {

            //check if params is greater than 1 limit of parameters within URL
            if (count(self::$router->getParams()) > 5){
                Router::redirect('/');
            }else {
                $view_path = $controller_object->$controller_method();
                if ($layout == 'ajax'){
                    echo json_encode($controller_object->getData());
                }else if ($layout == 'uploads'){

                }else {
                    $view_object = new View($controller_object->getData(), $view_path);

                    //buffer data and html template
                    $content = $view_object->buffer();

                    $layout_path = VIEW_PATH.DS.$layout.'.php';
                    $view = new View($content);
                    $view->render($layout_path);
                }

            }

        }else{

             //header("HTTP/1.0 404 Not Found");
            //Router::redirect("/page_not_found/");
            throw new Exception ("Method: ".$controller_method." of class " .$controller_class." does not exist!");
        }
    }

}
