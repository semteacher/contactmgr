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
    //    if(isset($_SESSION['loggeduser']['userRole'])){
    //        if($_SESSION['loggeduser']['userRole'] == 'admin'){
                parent::__construct($model, $action);
                $this->_setModel($model);
    //        } else {
    //            header('Location: /site/err403');
    //        }
    //    } else {
    //        header('Location: /site/err403');
            //Site::err403();
    //    }    
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
            echo "Application error - cannot display Contacts list: " . $e->getMessage();
        }
    }

    public function edit($contactId)
    {
        try {

            $this->_view->set('pageheader', 'Contact Details');
            $this->_view->set('title', 'Contact Details Form');

            $contact = $this->_model->getContactByIdAsArray((int)$contactId);

            if ($contact)
            {
                $this->_view->set('contact', $contact);
                $this->_view->set('mode', 'edit');
            }
            else
            {
                $this->_view->set('mode', 'add');
            }

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error - cannot display Contact data: " . $e->getMessage();
        }
    }

    public function save()
    {
        if (!isset($_POST['editcontactsubmit']))
        {
            header('Location: /contact/index');
            //$this->index();
        } elseif ($_POST['editcontactsubmit']=='cancel'){
            header('Location: /contact/index');
            //$this->index();
        }
        
        $errors = array();
        $check = true;
        
        //$tmpcontact = new $this->_model;
        $this->_model->setContactByArray($_POST['contact']);        
        
        $check = $this->_model->validateContact();

        //is it form data is valid?
        if (!$check)
        {
            $errors = $this->_model->validationErrors();
            
            $this->_setView('edit');
            $this->_view->set('title', 'Contact Details Form - Error');
            $this->_view->set('pageheader', 'Contact Details - Invalid contact form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('contact', $_POST['contact']);
            return $this->_view->output();
        }

        //store correct data
        try {

            $_POST['mode'] == 'add' ?  $this->_model->addContact() :  $this->_model->updateContact();

            $this->_setView('index');
            $this->_view->set('title', 'BundleJoy - Contact Manager');
            $this->_view->set('pageheader', 'Contact Management Main Page - store success!');

            $contacts = $this->_model->getAllContacts();
            $this->_view->set('contacts', $contacts);

        } catch (Exception $e) {
            $this->_setView('edit');
            $this->_view->set('title', 'Contact Details Form - Error');
            $this->_view->set('pageheader', 'Contact Details - There was an error saving the data!');
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('contact', $_POST['contact']);
            $this->_view->set('errors', $e->getMessage());
        }

        return $this->_view->output();
    }

    public function del($contactId)
    {
        $this->_setView('index');
        $this->_view->set('title', 'BundleJoy - Contact Manager');

        try {
            $this->_model->deleteContact((int)$contactId);

            $this->_view->set('pageheader', 'Contact Management Main Page - delete success!');

        } catch (Exception $e) {
            $this->_view->set('pageheader', 'Contact Management Main Page - error deleting!');
            $this->_view->set('errors', $e->getMessage());
        }

        $contacts = $this->_model->getAllContacts();
        $this->_view->set('contacts', $contacts);

        return $this->_view->output();
    }
}