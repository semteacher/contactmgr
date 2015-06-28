<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 27.06.2015
 * Time: 17:25
 */
class Controller
{
    public
        $cfg,
        $view,
        $table,
        $id,
        $db,
        $userValidation;
    protected
        $_model,
        $_controller,
        $_action;

    public function __construct($model = "Model", $controller = "Controller", $action = "index")
    {
        // register configurations from config.php
        global $cfg;
        // set config
        $this->cfg = $cfg;
        // construct MVC
        $this->_controller = $controller;
        $this->_action = $action;
        // initialise the template class
        $this->view = new Template($controller, $action);
        // call the function for derived class
        $this->init();
        // start contruct models
        $this->_model = new $model($this->db);
        $this->_model->controller = $this;
        $this->table = $controller;
    }

    /**
     * Initialize the required classes and variables
     */
    protected function init()
    {
        /* Put your code here*/
    }

    /**
     * Redirect to action
     */
    public function redirectToAction($action, $controller = false, $params = array())
    {
        if ($controller === false) {
            $controller = get_called_class();
        } else if (is_string($controller) && class_exists($controller . 'Controller')) {
            $controller = $controller . 'Controller';
            $controller = new $controller();
        }
        return call_user_func_array(array($controller, $action), $params);
    }

    /**
     * process default action view
     */
    public function defaultAction($params = null)
    {
        // make the default action path
        $path = MyHelpers::UrlContent("~/views/{$this->_controller}/{$this->_action}.php");
        var_dump($path);
        // if we have action name
        if (file_exists($path)) {
            $this->view->viewPath = $path;
        } else {
            $this->unknownAction();
        }
        // if we have parameters
        if (!empty($params) && is_array($params)) {
            // assign local variables
            foreach ($params as $key => $value) {
                $this->view->set($key, $value);
            }
        }
        // dispatch the result
        return $this->view();
    }

    /**
     * unknownAction
     */
    public function unknownAction($params = array())
    {
        // feed 404 header to the client
        header("HTTP/1.0 404 Not Found");
        // find custom 404 page
        $path = MyHelpers::UrlContent("~/views/shared/_404.php");
        // if we have custom 404 page, then use it
        if (file_exists($path)) {
            $this->view->viewPath = $path;
            return $this->view();
        } else {
            exit; //Do not do any more work in this script.
        }
    }

    /**
     * Returns the template result
     */
    public function view()
    {
        // dispatch the result of the template class
        return $this->view;
    }

    /**
     * set the variables
     */
    public function set($name, $value)
    {
        // set the parameters to the template class
        $this->view->set($name, $value);
    }
}