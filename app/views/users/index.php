<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 4.07.2015
 * Time: 17:55
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

    <div>
        <span><a href="/users/add">Add User</a></span>
        <span><h1><?php echo $pageheader; ?></h1></span>
    </div>
</p>
    <div>
        <span>User ID</span><span>UserName</span><span>Role</span>
    </div>

<?php if ($users): foreach ($users as $user):  ?>

    <div>
        <span><?php echo $user->getIdUser(); ?></span>
        <span><?php echo $user->getUserName(); ?></span>
        <span><?php echo $user->getRole(); ?></span>
        <span><a href="/users/edit/<?php echo $user->getIdUser(); ?>">Edit/View</a></span>
        <span><a href="/users/changepassword/<?php echo $user->getIdUser(); ?>">Change Password</a></span>
        <span><a href="/users/del/<?php echo $user->getIdUser(); ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></span>
    </div>

<?php
endforeach;
else: ?>

<h1>Welcome!</h1>
<p>We currently do not have any users.</p>

<?php endif; ?>

</p>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>