<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.06.2015
 * Time: 10:35
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<div>
    <span><h1><?php echo $pageheader; ?></h1></span>
</div>

<form action="/contacts/save" method="post" name="editcontact">
    <input type="hidden" value="<?php echo $mode; ?>" name="mode">
    <input type="hidden" value="<?php if(isset($contact)){echo $contact['id_contact'];} ?>" name="id_contact">
    <div><input type="text" value="<?php if(isset($contact)){echo $contact['fname'];} ?>" name="fname"></div>
    <div><input type="text" value="<?php if(isset($contact)){echo $contact['lname'];} ?>" name="lname"></div>
    <div><input type="text" value="<?php if(isset($contact)){echo $contact['email'];} ?>" name="email"></div>
    <div>
        <input type="submit" name="command" value="save">
        <input class="button" type="button" onclick="window.location.replace('/contacts/index')" value="Cancel" />
    </div>
</form>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>