<?php

/*
 The User Registration File Functions 
 */

include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

if (user_cookie_login_check($mysqli) == true) {
  $user_logged = 'in';
  
$error_msg = "";

if (isset($_POST['firstname']) and isset($_POST['secondname']) and isset($_POST['username']) and isset($_POST['email']) ) {
  
  // Sanitize and validate the data passed in
    $first_name = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $second_name = filter_input(INPUT_POST, 'secondname', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    
   
    
    $pre_email = $_POST['email'];
      // $pre_email Checking it's VALIDITY
    if (!filter_var($pre_email, FILTER_VALIDATE_EMAIL)) {
      // Not a valid email
      header('Location: ../options.php?invalidemail=true');
    }else {
      //Validating email / Assigning Variables
      $email = filter_var($pre_email, FILTER_VALIDATE_EMAIL);
    }
     
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

         


        if ($insert_stmt = $mysqli->prepare("UPDATE `members` SET `first_name`=? ,`second_name`= ? ,`username`= ?, `email`=? WHERE email = ?")) {
            $insert_stmt->bind_param('sssss', $first_name, $second_name,$username,$email, $account_email);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../options.php?updateerror=true');
                exit();
            }
        }
        header('Location: logout.php?relogin=true');


} 
} 
else {
  $user_logged = 'out';
  header("Location: ../../login.php?pleaselogin=true");
}
