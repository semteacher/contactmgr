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
    <input type="hidden" value="<?php if(isset($contact)){echo $contact['phone_best'];} ?>" name="contact[phone_best]">
    <div>First Name: <input type="text" value="<?php if(isset($contact)){echo $contact['fname'];} ?>" name="contact[fname]" required></div>
    <div>Last Name: <input type="text" value="<?php if(isset($contact)){echo $contact['lname'];} ?>" name="contact[lname]" required></div>
    <div>Email: <input type="email" value="<?php if(isset($contact)){echo $contact['email'];} ?>" name="contact[email]" required placeholder="A Valid Email Address"></div>
    <div>Phone (home): <input type="text" value="<?php if(isset($contact)){echo $contact['phone_h'];} ?>" name="contact[phone_h]"></div>
    <div>Phone (work): <input type="text" value="<?php if(isset($contact)){echo $contact['phone_w'];} ?>" name="contact[phone_w]"></div>
    <div>Phone (cell): <input type="text" value="<?php if(isset($contact)){echo $contact['phone_c'];} ?>" name="contact[phone_c]"></div>
    <div>Address 1: <input type="text" value="<?php if(isset($contact)){echo $contact['address1'];} ?>" name="contact[address1]"></div>
    <div>Address 2: <input type="text" value="<?php if(isset($contact)){echo $contact['address2'];} ?>" name="contact[address2]"></div>
    <div>City: <input type="text" value="<?php if(isset($contact)){echo $contact['city'];} ?>" name="contact[city]"></div>
    <div>State: <input type="text" value="<?php if(isset($contact)){echo $contact['state'];} ?>" name="contact[state]"></div>
    <div>Country: <input type="text" value="<?php if(isset($contact)){echo $contact['country'];} ?>" name="contact[country]"></div>
    <div>Zip: <input type="text" value="<?php if(isset($contact)){echo $contact['zip'];} ?>" name="contact[zip]"></div>
    <div>Birthday: <input type="text" value="<?php if(isset($contact)){echo $contact['birthday'];} ?>" name="contact[birthday]"></div>
    <div>
        <input type="submit" name="editcontactsubmit" value="save">
        <input class="button" type="button" onclick="window.location.replace('/contacts/index')" value="cancel" />
    </div>
</form>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>