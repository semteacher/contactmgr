<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 17:28
 */
class ContactManagerController
{
    public function index()
    {
        // we store all the contacts in a variable
        $contacts = Contacts::all();
        require_once('app'.DS.'views'.DS.'contacts'.DS.'index.php');
    }

    public function edit()
    {
        // we expect a url of form ?controller=contactmgr&action=show&id=x
        // without an id we just redirect to the error page as we need the post id to find it in the database
        if (!isset($_GET['id'])) {
            //return call('pages', 'error');

            // we use the given id to get the right contact
            $contact = Contacts::find($_GET['id']);
        }

        require_once('app'.DS.'views'.DS.'contacts'.DS.'edit.php');
    }

    public function save()
    {

    }

    public function del()
    {

    }
}

?>