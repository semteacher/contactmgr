<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 11:49
 */
$controller = 'site';
$action = 'index';
$query = null;

if (isset($_GET['load']))
{
    $params = array();
    $params = explode("/", $_GET['load']);

    $controller = ucwords($params[0]);

    if (isset($params[1]) && !empty($params[1]))
    {
        $action = $params[1];
    }

    if (isset($params[2]) && !empty($params[2]))
    {
        $query = $params[2];
    }
}

//check role/set default if nope
if(isset($_SESSION['loggeduser']['userRole'])){
    $userRole = $_SESSION['loggeduser']['userRole'];
} else {
    $userRole = DEFAULT_SITE_ROLE;
}

//check permissions
if (!isset($acl[$userRole][strtolower($controller)])){
    //redirect to 403
    $controller = 'site';
    $action = 'err403';
    $query = null;
} elseif (!in_array($action, $acl[$userRole][strtolower($controller)])){
//TODO:replace in_array!
    //redirect to 403
    $controller = 'site';
    $action = 'err403';
    $query = null;
}

$modelName = $controller;
$controller .= 'Controller';
$load = new $controller($modelName, $action);

if (method_exists($load, $action))
{
    $load->$action($query);
}
else
{
    die('Invalid method. Please check the URL.');
}