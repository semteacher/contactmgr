<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.06.2015
 * Time: 10:35
 */
?>
<p>Contact Details</p>
<form action="?controller=contactmgr&action=save" method="post" name="editcontact">
    <input type="hidden" value="<?php echo $mode; ?>" name="mode">
    <input type="hidden" value="<?php if(isset($contact)){echo $contact->id_contact;} ?>" name="id_contact">
    <div><input type="text" value="<?php if(isset($contact)){echo $contact->fname;} ?>" name="fname"></div>
    <div><input type="text" value="<?php if(isset($contact)){echo $contact->lname;} ?>" name="lname"></div>
    <div><input type="text" value="<?php if(isset($contact)){echo $contact->email;} ?>" name="email"></div>
    <div>
        <input type="submit" name="command" value="save">
        <input class="button" type="button" onclick="window.location.replace('?controller=contactmgr&action=index')" value="Cancel" />
    </div>
</form>