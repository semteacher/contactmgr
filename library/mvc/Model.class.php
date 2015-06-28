<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 27.06.2015
 * Time: 17:27
 */
class Model
{
    protected
        $_model;
    public
        $db,
        $controller;

    /**
     * Constructor for Model
     *
     */
    public function __construct($db)
    {
        $this->db = $db;
        $this->_model = get_class($this);
        $defaultModel = ($this->_model == 'Model');

        if (!$defaultModel) {
            $this->table = preg_replace('/Model$/', '', $this->_model);// remove ending Model
        }

        $this->init();
    }

    protected function init()
    {
        /* Put your code here*/
    }
}