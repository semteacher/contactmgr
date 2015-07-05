<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 16:18
 */
session_start();
 
define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

ini_set('display_errors', 1);

require_once HOME . DS . 'configs' . DS . 'db_conf.php';
require_once HOME . DS . 'configs' . DS . 'acl.php';
require_once HOME . DS . 'utils' . DS . 'bootstrap.php';

function __autoload($class)
{
   // var_dump($class);
    if (file_exists(HOME . DS . 'utils' . DS . strtolower($class) . '.Class.php')) {
        require_once HOME . DS . 'utils' . DS . strtolower($class) . '.Class.php';
    } else if (file_exists(HOME . DS . 'app'. DS .'models' . DS . strtolower($class) . '.Class.php')) {
        require_once HOME . DS . 'app'. DS .'models' . DS . strtolower($class) . '.Class.php';
    } else if (file_exists(HOME . DS .'app'. DS . 'controllers' . DS . strtolower($class) . '.Class.php')) {
        require_once HOME . DS . 'app'. DS . 'controllers' . DS . strtolower($class) . '.Class.php';
    }
}