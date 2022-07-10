<?php require("./views/headers.php"); ?>
<?php
    if(empty($sessionUser)){
        require ("./views/login.php");
    }else{
        require ("dashboard/dashboard.php");
    }
?>

<?php require("./views/footer.php");?>