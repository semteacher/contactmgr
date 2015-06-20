<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 16:18
 */
define ('DS', DIRECTORY_SEPARATOR);
//define ('HOME', dirname(__FILE__));

require_once('configs' . DS . 'db_conf.php');
require_once('utils' . DS . 'connection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'pages';
    $action = 'home';
}

require_once('app' . DS . 'views' . DS . 'layout.php');
?>