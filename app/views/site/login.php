<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 10:35
 */
?>
<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_header.inc.php'; ?>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_menu.inc.php'; ?>

<div>
    <span><h2><?php echo $pageheader; ?></h2></span>
</div>
<div class="errbox"><?php if(isset($loginerr)){echo $loginerr;} ?></div>
<form action="<?php echo SITE_ROOT; ?>/site/login" method="post" name="loginuser">
    <div>Username: <input type="text" value="" name="username" required></div>
    <div>Password: <input type="password" value="" name="password" required></div>
    <div>
        <input type="submit" name="loginusersubmit" value="login">
        <input class="button" type="button" onclick="window.location.replace('<?php echo SITE_ROOT; ?>/site/index')" value="cancel" />
    </div>
</form>

<?php include HOME . DS . 'app' . DS . 'views' . DS . 'includes' . DS . 'common_footer.inc.php'; ?>