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

//    public function __construct()
//    {
//        parent::__construct();
//    }
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
        $contactlist = [];

        $sql = "SELECT
                    *
                FROM
                    contacts c";

        $this->_setSql($sql);
        $contacts = $this->getAll();
var_dump($contacts);
        if (empty($contacts))
        {
            return false;
        } else {
            foreach ($contacts as $contact) {
                $tmpcontact = new ContactsModel;
                $tmpcontact->setIdContact($contact['id_contact']);
                $tmpcontact->setFirstName($contact['fname']);
                $tmpcontact->setLastName($contact['lname']);
                $tmpcontact->setEmail($contact['email']);
                array_push($contactlist, $tmpcontact);
            }
            var_dump($contactlist);
            return $contactlist;
        }


    }

    public function getContactById($id)
    {
        $sql = "SELECT
                    *
                FROM
                    contacts c
                WHERE
                    c.id_contact = ?";

        $this->_setSql($sql);
        $contactDetails = $this->getRow(array($id));

        if (empty($contactDetails))
        {
            return false;
        } else {
            return $contactDetails;
        }

    }
}