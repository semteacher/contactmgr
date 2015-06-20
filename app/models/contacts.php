<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 17:43
 */
class Contacts
{
    // we define 3 attributes
    // they are public so that we can access them using $contact->fname directly
    public $id_contact;
    public $fname;
    public $lname;

    public function __construct($id_contact, $fname, $lname)
    {
        $this->id_contact = $id_contact;
        $this->fname = $fname;
        $this->lname = $lname;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM contacts');

        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $contact) {
            $list[] = new Contacts($contact['id_contact'], $contact['fname'], $contact['lname']);
        }

        return $list;
    }

    public static function find($id_contact)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id_contact = intval($id_contact);
        $req = $db->prepare('SELECT * FROM contacts WHERE id_contact = :id_contact');
        // the query was prepared, now we replace :id with our actual $id value
        $req->execute(array('id_contact' => $id_contact));
        $contact = $req->fetch();

        return new Contacts($contact['id_contact'], $contact['fname'], $contact['lname']);
    }
}

?>