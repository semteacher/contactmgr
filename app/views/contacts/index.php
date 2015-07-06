<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 17:55
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <div>
        <span><a href="/contacts/edit">Add</a></span>
        <span><h1><?php echo $pageheader; ?></h1></span>
    </div>
</p>

<div class="errbox">
<?php
    if(isset($errors)){
        echo 'Error(s): ';
        foreach ($errors as $error){echo '<span>'.$error.'</span>';
    }} 
?>
</div>

    <div>
        <span>First</span><span>Last</span><span>E-mail</span><span>Best phone</span><span>Address 1</span><span>Address 2</span><span>City</span><span>State</span><span>Country</span><span>Zip</span><span>Birthday</span>
    </div>

<?php if ($contacts): foreach ($contacts as $contact):  ?>

    <div>
        <span><?php echo $contact->getFirstName(); ?></span>
        <span><?php echo $contact->getLastName(); ?></span>
        <span><?php echo $contact->getEmail(); ?></span>
        <span><?php echo $contact->getPhoneHome(); ?></span>
        <span><?php echo $contact->getPhoneWork(); ?></span>
        <span><?php echo $contact->getPhoneCell(); ?></span>
        <span><?php echo $contact->getAddress1(); ?></span>
        <span><?php echo $contact->getAddress2(); ?></span>
        <span><?php echo $contact->getCity(); ?></span>
        <span><?php echo $contact->getState(); ?></span>
        <span><?php echo $contact->getCountry(); ?></span>
        <span><?php echo $contact->getZip(); ?></span>
        <span><?php echo $contact->getBirthday(); ?></span>
        <span><a href="/contacts/edit/<?php echo $contact->getIdContact(); ?>">Edit/View</a></span>
        <span><a href="/contacts/del/<?php echo $contact->getIdContact(); ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></span>
    </div>

<?php
endforeach;
else: ?>

<h1>Welcome!</h1>
<p>We currently do not have any contact.</p>

<?php endif; ?>

</p>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>