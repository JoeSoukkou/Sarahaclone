
<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'functions.php';

@admin_sec_session_start(); // Our custom secure way of starting a PHP session.
if (admin_cookie_login_check($mysqli) == true){
    if (isset($_POST['delete'])){
        $email_ = $_POST['delete'];
        $delete_stmt = $mysqli->prepare("DELETE FROM `members` WHERE `members`.`email` = ?");
        $delete_stmt->bind_param('s',$email_);
            // Execute the prepared query.
        $delete_stmt->execute();
        header("location: ../Panel/users.php");
    
    }
    if (isset($_POST['block'])){
        $email_ = $_POST['block'];
        $delete_stmt = $mysqli->prepare("UPDATE `members` SET `blocked`=1 WHERE `email` = ?");
        $delete_stmt->bind_param('s',$email_);
            // Execute the prepared query.
        $delete_stmt->execute();
        header("location: ../Panel/users.php");
    
    }
    if (isset($_POST['unblock'])){
        $email_ = $_POST['unblock'];
        $delete_stmt = $mysqli->prepare("UPDATE `members` SET `blocked`=0 WHERE `email` = ?");
        $delete_stmt->bind_param('s',$email_);
            // Execute the prepared query.
        $delete_stmt->execute();
        header("location: ../Panel/users.php");
    
    }
    

}
else{
    $user_logged = 'out';
    header("Location: ../index.php?pleaselogin=true");
}

?>