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

    /**
     * set session using cookie
     * @return void
     */
    public static function setSession(){
       if (isset($_COOKIE['userid'])) Session::set('userid', $_COOKIE['userid']);
       if (isset($_COOKIE['username'])) Session::set('username', $_COOKIE['username']);
       if (isset($_COOKIE['email'])) Session::set('email', $_COOKIE['email']);
       if (isset($_COOKIE['access'])) Session::set('access', $_COOKIE['access']);
       if (isset($_COOKIE['avatar'])) Session::set('avatar', $_COOKIE['photo']);
       if (isset($_COOKIE['fname'])) Session::set('fname', $_COOKIE['fname']);
       if (isset($_COOKIE['lname'])) Session::set('lname', $_COOKIE['lname']);
    }

    public static function run($uri){
        self::$router = new Router($uri);
        self::$db = new DB(Config::get('db_host'),Config::get('db_username'),Config::get('db_password'),Config::get('db_name'));

        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

        //get layout
        $layout = self::$router->getRoute();

        //get access
        $current_session_access =  Session::get('access');
        $access = !isset($current_session_access) ? (!isset($_COOKIE['access']) ? null : $_COOKIE['access']) : $current_session_access;
        
        //if cookie is found set session using cookie
        if (isset($_COOKIE['access']) && !isset($current_session_access)){
            self::setSession();
        }

        //if not sign-in and layout is admin go to admin login page
        if ($layout == 'admin'){
            if ( !isset($access) && self::$router->getController() != 'login'){
                Router::redirect('/admin/login/');
            }       
        }

        //TODO: handle seller and buyer account access

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
