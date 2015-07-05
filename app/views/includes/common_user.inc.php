<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 10:46
 */
?>
<div>
<?php 
if(isset($_SESSION['loggeduser'])){
?>
<span>
<?php
    echo 'User: '.$_SESSION['loggeduser']['userName'];
    if(isset($_SESSION['loggeduser']['userRole'])){
        echo ' ('.$_SESSION['loggeduser']['userRole'].')';
    }    
?>
</span><span><a href="/site/logout">Logout</a></span>
<?php    
} else {
?>
<span><a href="/site/login">Login</a></span>
<?php 
} 
?>
</div>