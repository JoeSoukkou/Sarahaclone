
<?php
include_once 'db_connect.php';
include_once 'functions.php';

@user_sec_session_start(); // Our custom secure way of starting a PHP session.
if (user_cookie_login_check($mysqli) == true){
    if (isset($_POST['deletemyaccount']) and $_POST['deletemyaccount'] == "yesdeletemyaccount"){

        $stmt = $mysqli->prepare("SELECT email 
				  FROM members
                                  WHERE password = ? LIMIT 1");
        $token = $_COOKIE["Xtoken"];
        $stmt->bind_param('s', $token);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($account_email);
        $stmt->fetch();





        $delete_stmt = $mysqli->prepare("DELETE FROM `members` WHERE `members`.`email` = ?");
        $delete_stmt->bind_param('s',$account_email);
            // Execute the prepared query.
        $delete_stmt->execute();
        header("location: logout.php?deletedaccount=true");
    
    }
}else {
    header("Location: ../../login.php?pleaselogin=true");
}   