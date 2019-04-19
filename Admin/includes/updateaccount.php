<?php

/*
 The User Registration File Functions 
 */

include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

if (admin_cookie_login_check($mysqli) == true) {
  $user_logged = 'in';
  
$error_msg = "";

if (isset($_POST['firstname']) and isset($_POST['secondname']) and isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['passwordconfirm'])  ) {
  
  // Sanitize and validate the data passed in
    $first_name = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $second_name = filter_input(INPUT_POST, 'secondname', FILTER_SANITIZE_STRING);
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    
    //The bio 
    $bio = filter_input(INPUT_POST, 'bio', FILTER_SANITIZE_STRING);
    
    $pre_email = $_POST['email'];
      // $pre_email Checking it's VALIDITY
    if (!filter_var($pre_email, FILTER_VALIDATE_EMAIL)) {
      // Not a valid email
      $error_msg .= 'invalidEmail';
    }else {
      //Validating email / Assigning Variables
      $email = filter_var($pre_email, FILTER_VALIDATE_EMAIL);
    }
     


      /* Backend check for Passwrod Validity */
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password_confirm = filter_input(INPUT_POST, 'passwordconfirm', FILTER_SANITIZE_STRING);
    if ($password != $password_confirm or $password == '' or $password_confirm==''){
      $error_msg .= 'invalidPassword';
    }
    /*if (strlen($password) != 128) {
        // The hashed pwds should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= 'invalidPassword';
    }*/
    
    // Username validity and password validity have been checked client side as well , so these are just extra steps to secure the script.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    // Should not worry about client side Password and Email verification :)

    $prep_stmt = "SELECT id FROM admins WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
    }else {
      $error_msg .= 'GeneralError';
  } 
      


    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);
        $email_old = $_COOKIE['Aemail'];
        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("UPDATE `admins` SET `first_admin_name`=? ,`second_admin_name`= ? ,`adminname`= ?,`password`=? ,`salt`=?, `email`=? ,`bio`= ? WHERE email = ?")) {
            $insert_stmt->bind_param('ssssssss', $first_name, $second_name,$username,$password,$random_salt, $email, $bio, $email_old);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../myaccount.php?registererror=true');
                exit();
            }
        }
        header('Location: ../index.php?relogin=true');
        
    }else {
        if ($error_msg == "invalidPassword"){
          header('Location: ../Panel/myaccount.php?invalid_password=true');
        }
        else if ($error_msg == "invalidEmail"){
          header('location: ../Panel/myaccount.php?invalid_email=true');
        }else if ($error_msg == "GeneralError"){
          header('Location: ../Panel/myaccount.php?registererror=true');
        }else if ($error_msg == "invalid_agreement"){
          
          header('location: ../Panel/myaccount.php?invalidAgree=true');
        }else{
          header('location: ../Panel/myaccount.php?unknownError=true');
        }

    }
}else {
  echo "not all variables are set ! ";
}

} else {
  $user_logged = 'out';
  header("Location: ../index.php?pleaselogin=true");
}
