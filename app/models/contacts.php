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

    public function __construct($id_contact, $fname, $lname, $email)
    {
        $this->id_contact = $id_contact;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT * FROM contacts');

        // we create a list of Post objects from the database results
        foreach ($req->fetchAll() as $contact) {
            $list[] = new Contacts($contact['id_contact'], $contact['fname'], $contact['lname'], $contact['email']);
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

        return new Contacts($contact['id_contact'], $contact['fname'], $contact['lname'], $contact['email']);
    }

    public static function add($fname, $lname, $email)
    {
        $db = Db::getInstance();
        $sql = 'INSERT INTO contacts (fname, lname, email) VALUES ("'.$fname.'", "'.$lname.'", "'.$email.'")';
        try {
            $req = $db->exec($sql);
        }
        catch (PDOException $e) {
            //echo $sql . "<br>" . $e->getMessage();
            return call('pages', 'error');
        }

    }

    public static function delete($id_contact)
    {
        $db = Db::getInstance();
        // we make sure $id is an integer
        $id_contact = intval($id_contact);
        try {
            $sql = 'DELETE FROM contacts WHERE id_contact = '.$id_contact;
            // the query was prepared, now we replace :id with our actual $id value
            $req = $db->exec($sql);
        }
        catch (PDOException $e) {
            //echo $sql . "<br>" . $e->getMessage();
            return call('pages', 'error');
        }
    }
}

?>