<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 16:18
 */

// Ensure we have session
if(session_id() === ""){
    session_start();
}

// define the directory separator
define ('DS', DIRECTORY_SEPARATOR);
// define the application path
define('ROOT', dirname(dirname(__FILE__)));

// the routing url, we need to use original 'QUERY_STRING' from server paramater because php has parsed the url if we use $_GET
$_route = isset($_GET['_route']) ? preg_replace('/^_route=(.*)/','$1',$_SERVER['QUERY_STRING']) : '';

// start to dispatch
require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');

//require_once('..'.DS .'configs' . DS . 'db_conf.php');
//require_once('..'.DS .'utils' . DS . 'connection.php');

//if (isset($_GET['controller']) && isset($_GET['action'])) {
//    $controller = $_GET['controller'];
//    $action = $_GET['action'];
//} else {
//    $controller = 'pages';
//    $action = 'home';
//}

//require_once('..'.DS .'app' . DS . 'views' . DS . 'layout.php');
