<?php

Config::set('site_name','');

Config::set('languages', array('en', 'ph'));

Config::set('routes', array(

    'default' => '',

    'admin' => 'admin_',

    'ajax' => 'ajax_',

    'uploads' => 'upload_',

     'print' => 'print_',

));



Config::set('default_route', 'default');

Config::set('default_language', 'en');

Config::set('default_controller', 'home');

Config::set('default_action', 'index');



Config::set('db_host', 'localhost');

Config::set('db_username', 'root');

Config::set('db_password', '');

Config::set('db_name', 'lccc_db');

Config::set('limit', 20);

Config::set('orientation', 'portrait');
