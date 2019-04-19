
<?php
include_once 'db_connect.php';
include_once 'functions.php';

@admin_sec_session_start(); // Our custom secure way of starting a PHP session.
if (admin_cookie_login_check($mysqli) == true) {

if (isset($_POST['delete'])){
    $email_ = $_POST['delete'];
    $delete_stmt = $mysqli->prepare("DELETE FROM `admins` WHERE `admins`.`email` = ?");
    $delete_stmt->bind_param('s',$email_);
        // Execute the prepared query.
    $delete_stmt->execute();
    header("location: ../Panel/admins.php");

}}
else {
    $user_logged = 'out';
    header("Location: ../index.php?pleaselogin=true");
      
}

?>