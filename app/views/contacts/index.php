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
    <div>
        <span>First</span><span>Last</span><span>E-mail</span><span>Best phone</span>
    </div>

<?php if ($contacts): foreach ($contacts as $contact):  ?>

    <div>
        <span><?php echo $contact['fname']; ?></span>
        <span><?php echo $contact['lname']; ?></span>
        <span><?php echo $contact['email']; ?></span>
        <span><a href="/contacts/edit/<?php echo $contact['id_contact']; ?>">Edit/View</a></span>
        <span><a href="/contacts/del/<?php echo $contact['id_contact']; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></span>
    </div>

<?php
endforeach;
else: ?>

<h1>Welcome!</h1>
<p>We currently do not have any contact.</p>

<?php endif; ?>

</p>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>