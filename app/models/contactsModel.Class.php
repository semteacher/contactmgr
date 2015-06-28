<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 18:12
 */

class ContactsModel extends Model {

    public function getAllContacts()
    {
        $sql = "SELECT
                    *
                FROM
                    contacts c";

        $this->_setSql($sql);
        $contacts = $this->getAll();

        if (empty($contacts))
        {
            return false;
        }

        return $contacts;
    }
}