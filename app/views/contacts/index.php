<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 20.06.2015
 * Time: 17:55
 */
?>
    <div>
        <span><a href='?controller=contactmgr&action=view'>Add</a></span>
        <span>Management Main Page </span>
    </div>
</p>
    <div>
        <span>First</span><span>Last</span><span>E-mail</span><span>Best phone</span>
    </div>

<?php foreach ($contacts as $contact) { ?>

    <div>
        <span><?php echo $contact->fname; ?></span>
        <span><?php echo $contact->lname; ?></span>
        <span><a href='?controller=contactmgr&action=view&id=<?php echo $contact->id_contact; ?>'>Edit/View</a></span>
    </div>

<?php } ?>
</p>