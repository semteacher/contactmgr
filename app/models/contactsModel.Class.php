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

    public function setContact($idContact=NULL, $firstName, $lastName, $email, $phoneHome=Null)
    {
        $this->_idContact = $idContact;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_phoneHome = $phoneHome;
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
                $tmpcontact->setContact($contact['id_contact'], $contact['fname'], $contact['lname'], $contact['email']);
//                $tmpcontact->setIdContact($contact['id_contact']);
//                $tmpcontact->setFirstName($contact['fname']);
//                $tmpcontact->setLastName($contact['lname']);
//                $tmpcontact->setEmail($contact['email']);
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
                    c.fname=?, c.lname=?, c.email=?
                WHERE
                    c.id_contact = ?";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email,
            $this->_idContact
            //$this->_message
        );

        $sth = $this->_db->prepare($sql);
        return $sth->execute($contactData);
    }

    public function addContact()
    {
        $sql = "INSERT INTO contacts
                    (fname, lname, email)
                VALUES
                    (?, ?, ?)";

        $contactData = array(
            $this->_firstName,
            $this->_lastName,
            $this->_email
            //$this->_message
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