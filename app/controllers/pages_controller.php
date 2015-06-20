<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 16:53
 */
class PagesController
{
    public function home()
    {
        $first_name = 'Jon';
        $last_name = 'Snow';
        require_once('app'.DS.'views'.DS.'pages'.DS.'home.php');
    }

    public function error()
    {
        require_once('app'.DS.'views'.DS.'pages'.DS.'error.php');
    }
}

?>