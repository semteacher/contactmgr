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

<div class="errbox">
<?php
    if(isset($errors)){
        echo 'Error(s): ';
        foreach ($errors as $error){echo '<span>'.$error.'</span>';
    }} 
?>
</div>

<form action="/contacts/save" method="post" name="editcontact">
    <input type="hidden" value="<?php echo $mode; ?>" name="mode">
    <input type="hidden" value="<?php if(isset($contact)){echo $contact['id_contact'];} ?>" name="contact[id_contact]">
    <div>First Name: <input type="text" value="<?php if(isset($contact)){echo $contact['fname'];} ?>" name="contact[fname]" required></div>
    <div>Last Name: <input type="text" value="<?php if(isset($contact)){echo $contact['lname'];} ?>" name="contact[lname]" required></div>
    <div>Email: <input type="email" value="<?php if(isset($contact)){echo $contact['email'];} ?>" name="contact[email]" required placeholder="A Valid Email Address"></div>
    <div>Phone (home): <input type="text" value="<?php if(isset($contact)){echo $contact['phone_h'];} ?>" name="contact[phone_h]"></div>
    <div>
        <input type="submit" name="editcontactsubmit" value="save">
        <input class="button" type="button" onclick="window.location.replace('/contacts/index')" value="cancel" />
    </div>
</form>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>