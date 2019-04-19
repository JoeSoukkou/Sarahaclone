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

if (isset($_POST['oldpassword']) and isset($_POST['newpassword']) and isset($_POST['newpasswordconfirm']) ) {
  
  // Sanitize and validate the data passed in
    $s_oldpass = filter_input(INPUT_POST, 'oldpassword', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $newpass = filter_input(INPUT_POST, 'newpassword', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $newpassconf = filter_input(INPUT_POST, 'newpasswordconfirm', FILTER_SANITIZE_STRING);
    
   
    $stmt = $mysqli->prepare("SELECT password, salt
				  FROM members
                                  WHERE email = ? LIMIT 1");
        $email = $_COOKIE['Xemail'];
        
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($db_password, $salt);
        $stmt->fetch();
     
       

        $hashed_s_oldpass = hash('sha512', $s_oldpass . $salt);

     
        if ($hashed_s_oldpass != $db_password){
            header("location: ../members/optionspass.php?invalidoldpass=true");
            exit();
        }
        

           /* Backend check for Passwrod Validity */
           
            if ($newpass != $newpassconf){
                header("location: ../members/optionspass.php?invalidpasscomb=true");
                exit();

            }else {
                        // Create a random salt
                $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

                // Create salted password
                $newpassword = hash('sha512', $newpass . $random_salt);
            }
    
         


        if ($insert_stmt = $mysqli->prepare("UPDATE `members` SET `password`=? ,`salt`=? WHERE email = ?")) {
            $insert_stmt->bind_param('sss', $newpassword, $random_salt, $email);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../members/optionspass.php?passupdateerror=true');
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
