<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 10:46
 */
?>
<span class="inline alignright">
<nav>
    <ul id="usermenu">    
<?php 
if(isset($_SESSION['loggeduser'])){
?>
        <li><span><strong>
<?php
    echo 'User: '.$_SESSION['loggeduser']['userName'];
    if(isset($_SESSION['loggeduser']['userRole'])){
        echo ' ('.$_SESSION['loggeduser']['userRole'].')';
    }    
?>
        </strong></span></li>
        <li><span><a href="/site/logout">Logout</a></span></li>
<?php    
} else {
?>
        <li><span><a href="/site/login">Login</a></span></li>
<?php 
} 
?>
    </ul>
</nav>    
</span>