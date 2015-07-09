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

if (dirname($_SERVER['SCRIPT_NAME']) !=DIRECTORY_SEPARATOR) {
    define ('SITE_ROOT', dirname($_SERVER['SCRIPT_NAME']));
} else {
    define ('SITE_ROOT', '');
}

//$serverroot = $_SERVER["DOCUMENT_ROOT"];
//$domain    = $_SERVER['SERVER_NAME'];
//$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
//$doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
//$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
//
//print_r(DIRECTORY_SEPARATOR);
//print_r('<br>');
//print_r(basename(__FILE__));
//print_r('<br>');
//print_r($_SERVER['DOCUMENT_ROOT']);
//print_r('<br>');
//print_r($_SERVER['SERVER_NAME']);
//print_r('<br>');
//print_r($_SERVER['SCRIPT_NAME']);
//print_r('<br>');
//print_r(dirname($_SERVER['SCRIPT_NAME']));
//print_r('<br>');
//print_r($_SERVER['SCRIPT_FILENAME']);
//print_r('<br>');
//print_r($siteroot);
//print_r('<br>--');
//$localpath=getenv("SCRIPT_NAME");
//print_r($localpath);
//print_r('<br>--');
//$absolutepath=realpath($localpath);
//print_r($absolutepath);
//print_r('<br>--');
//// a fix for Windows slashes
//$absolutepath=str_replace("\\","/",$absolutepath);
//print_r($absolutepath);
//print_r('<br>--');
//$docroot=substr($absolutepath,0,strpos($absolutepath,$localpath));
//print_r($docroot);

ini_set('display_errors', 1);

require_once HOME . DS . 'configs' . DS . 'app_conf.php';
require_once HOME . DS . 'configs' . DS . 'db_conf.php';
require_once HOME . DS . 'configs' . DS . 'acl.php';
require_once HOME . DS . 'utils' . DS . 'bootstrap.php';

function __autoload($class)
{
   // var_dump($class);
    if (file_exists(HOME . DS . 'utils' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'utils' . DS . $class . '.Class.php';
    } else if (file_exists(HOME . DS . 'app'. DS .'models' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'app'. DS .'models' . DS . $class . '.Class.php';
    } else if (file_exists(HOME . DS .'app'. DS . 'controllers' . DS . $class . '.Class.php')) {
        require_once HOME . DS . 'app'. DS . 'controllers' . DS . $class . '.Class.php';
    }
}