<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:12
 */

class ContactsModel extends Model {
    private $_idContact;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_phoneHome;
    
    private $_errors;

//    public function __construct()
//    {
//        parent::__construct();
//    }

    public function setContact($idContact=NULL, $firstName, $lastName, $email, $phoneHome=Null)
    {
        $this->_idContact = $idContact;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_phoneHome = $phoneHome;
    }
    
    public function setContactByArray($contactDeatils)
    {
        $this->_idContact = isset($contactDeatils['id_contact']) ? trim($contactDeatils['id_contact']) : NULL;
        $this->_firstName = isset($contactDeatils['fname']) ? trim($contactDeatils['fname']) : NULL;
        $this->_lastName = isset($contactDeatils['lname']) ? trim($contactDeatils['lname']) : NULL;
        $this->_email = isset($contactDeatils['email']) ? trim($contactDeatils['email']) : NULL;
        $this->_phoneHome = isset($contactDeatils['phone_h']) ? trim($contactDeatils['phone_h']) : NULL;
    }
    
    public function validateContactByArray($contactDeatils)
    {
    }
    
    public function validateContact()
    {
        $errors = array();
        $check = true;
        
        if (empty($this->_firstName))
        {
            $check = false;
            array_push($errors, "First Name is required!");
        }

        if (empty($this->_lastName))
        {
            $check = false;
            array_push($errors, "Last Name is required!");
        }

        if (empty($this->_email))
        {
            $check = false;
            array_push($errors, "E-mail is required!");
        }
//        else if (!filter_var( $email, FILTER_VALIDATE_EMAIL ))
//        {
//            $check = false;
//            array_push($errors, "Invalid E-mail!");
//        }

        if (empty($this->_phoneHome))
        {
            $check = false;
            array_push($errors, "At least one phone is required!");
        }
        
        if (!$check) {
            $this->_errors = $errors;
            return false;
        } else {
            return true;
        }
    }
    
    public function validationErrors() 
    {
        return $this->_errors;
    }
    
    /**
     * @param mixed $idContact
     */
    public function setIdContact($idContact)
    {
        $this->_idContact = $idContact;
    }

    /**
     * @return mixed
     */
    public function getIdContact()
    {
        return $this->_idContact;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    public function setPhoneHome($phoneHome)
    {
        $this->_phoneHome = $phoneHome;
    }

    /**
     * @return mixed
     */
    public function getPhoneHome()
    {
        return $this->_phoneHome;
    }

    public function getAllContacts()
    {
        $contactList = [];

        $sql = "SELECT
                    *
                FROM
                    contacts c";

        $this->_setSql($sql);
        $contacts = $this->getAll();
//var_dump($contacts);
        if (empty($contacts))
        {
            return false;
        } else {
            foreach ($contacts as $contact) {
                $tmpcontact = new ContactsModel;
                //$tmpcontact->setContact($contact['id_contact'], $contact['fname'], $contact['lname'], $contact['email']);
                $tmpcontact->setContactByArray($contact);
                array_push($contactList, $tmpcontact);
            }
//var_dump($contactlist);
            return $contactList;
        }


    }

    public function getContactByIdAsArray($id_contact)
    {
        $id_contact = intval($id_contact);

        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.id_contact = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id_contact));

        if (empty($contactDetails))
        {
            return false;
        } else {
            return $contactDetails;
        }

    }

    public function getContactById($id_contact)
    {
        $id_contact = intval($id_contact);

        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.id_contact = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id_contact));

        if (empty($contactDetails))
        {
            return false;
        } else {

            $this->_firstName = $contactDetails['fname'];
            $this->_lastName = $contactDetails['lname'];
            $this->_email = $contactDetails['email'];
            $this->_idContact = $contactDetails['id_contact'];

            return $this;
        }

    }

    public function updateContact()
    {
        $sql = "UPDATE contacts c
                SET
                    c.fname=?, c.lname=?, c.email=?, c.phone_h=?
                WHERE
                    c.id_contact = ?";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email,
            $this->_phoneHome,
            $this->_idContact
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($contactData);
    }

    public function addContact()
    {
        $sql = "INSERT INTO contacts
                    (fname, lname, email, phone_h)
                VALUES
                    (?, ?, ?, ?)";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email,
            $this->_phoneHome
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($contactData);
    }

    public function deleteContact($id_contact) {
        // we make sure $id is an integer
        $id_contact = intval($id_contact);

        $sql = 'DELETE FROM contacts WHERE id_contact = '.$id_contact;

        return $sth = $this->_db->exec($sql);

    }
}