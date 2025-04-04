<?php
/**
 *  define routes with its controllers and actions 
 */
const routes = array(
    '/crud-mvc/'             => array('HomeController', 'index'),
    '/crud-mvc/home'         => array('HomeController', 'index'),
    '/crud-mvc/users'        => array('UserController', 'index'),
    '/crud-mvc/users/load'   => array('UserController', 'load'),
    '/crud-mvc/users/show'   => array('UserController', 'getDetail'),
    '/crud-mvc/users/add'    => array('UserController', 'add'),
    '/crud-mvc/users/edit'   => array('UserController', 'edit'),
    '/crud-mvc/users/delete' => array('UserController', 'delete'),
);
