<div class="errbox">
    <?php
    if(isset($errors)){
        echo 'Error(s): ';
        foreach ($errors as $error){echo '<span>'.$error.'</span>';
        }}
    ?>
</div>