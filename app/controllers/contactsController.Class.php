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
            //header('Location: /contact/index');
            $this->index();
        } elseif ($_POST['editcontactsubmit']=='cancel'){
            //header('Location: /contact/index');
            $this->index();
        }
        $errors = array();
        $check = true;

        //get POST data
        $firstName = isset($_POST['fname']) ? trim($_POST['fname']) : NULL;
        $lastName = isset($_POST['lname']) ? trim($_POST['lname']) : NULL;
        $email = isset($_POST['email']) ? trim($_POST['email']) : "";
        $phoneHome = isset($_POST['phone_h']) ? trim($_POST['phone_h']) : "0000";

        //form data validation
        if (empty($firstName))
        {
            $check = false;
            array_push($errors, "First Name is required!");
        }

        if (empty($lastName))
        {
            $check = false;
            array_push($errors, "Last Name is required!");
        }

        if (empty($email))
        {
            $check = false;
            array_push($errors, "E-mail is required!");
        }
//        else if (!filter_var( $email, FILTER_VALIDATE_EMAIL ))
//        {
//            $check = false;
//            array_push($errors, "Invalid E-mail!");
//        }

        if (empty($phoneHome))
        {
            $check = false;
            array_push($errors, "At least one phone is required!");
        }

        //form data is invalid
        if (!$check)
        {
            $this->_setView('edit');
            $this->_view->set('title', 'Contact Details Form - Error');
            $this->_view->set('pageheader', 'Contact Details - Invalid contact form data!');
            $this->_view->set('errors', $errors);
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('contact', $_POST);
            return $this->_view->output();
        }

        //store correct data
        try {
//var_dump($_POST);
            $contact = $_POST['mode'] == 'add' ? new $this->_model : $this->_model->getContactById((int)$_POST['id_contact']);
            $contact->setFirstName($firstName);
            $contact->setLastName($lastName);
            $contact->setEmail($email);
            $contact->setPhoneHome($phoneHome);
//var_dump($contact);
            $_POST['mode'] == 'add' ? $contact->addContact() : $contact->updateContact();


            $this->_setView('index');
            $this->_view->set('title', 'BundleJoy - Contact Manager');
            $this->_view->set('pageheader', 'Contact Management Main Page - store success!');

//            $data = array(
//                'firstName' => $firstName,
//                'lastName' => $lastName,
//                'email' => $email,
//                'message' => $phoneHome
//            );
//
//            $this->_view->set('userData', $data);

            $contacts = $this->_model->getAllContacts();
            $this->_view->set('contacts', $contacts);

        } catch (Exception $e) {
            $this->_setView('edit');
            $this->_view->set('title', 'Contact Details Form - Error');
            $this->_view->set('pageheader', 'Contact Details - There was an error saving the data!');
            $this->_view->set('mode', $_POST['mode']);
            $this->_view->set('contact', $_POST);
            $this->_view->set('saveError', $e->getMessage());
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
        }

        $contacts = $this->_model->getAllContacts();
        $this->_view->set('contacts', $contacts);

        return $this->_view->output();
    }
}