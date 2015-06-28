<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:10
 */

class ContactsController extends Controller {
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {

            $contacts = $this->_model->getAllContacts();
            $this->_view->set('contacts', $contacts);
            $this->_view->set('title', 'BundleJoy - Contact Manager');
            $this->_view->set('pageheader', 'Contact Management Main Page');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}