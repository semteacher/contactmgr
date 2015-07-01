<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 17:37
 */

class SiteController extends Controller {
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'Wellcome BundleJoy Inc. Site!');
            $this->_view->set('title', 'BundleJoy Inc.');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}