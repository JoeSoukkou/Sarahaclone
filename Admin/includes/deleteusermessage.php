
<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions.php';

@admin_sec_session_start(); // Our custom secure way of starting a PHP session.



if (admin_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
    if (isset($_POST['deleteusermessage'])){
        $msg_id= $_POST['deleteusermessage'];
        $delete_stmt = $mysqli->prepare("DELETE FROM `dash_messages` WHERE `dash_messages`.`id` = ?");
        $delete_stmt->bind_param('s',$msg_id);
            // Execute the prepared query.
        $delete_stmt->execute();
        header("location: ../Panel/messages.php");
    
    }
    }else{
        $user_logged = 'out';
        header("Location: ../index.php?pleaselogin=true");
    }
?>