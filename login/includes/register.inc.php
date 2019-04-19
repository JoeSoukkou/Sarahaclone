<?php

/*
 The User Registration File Functions 
 */

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";

if (isset($_POST['firstname']) and isset($_POST['secondname']) and isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['passwordconfirm']) ) {
  //Verify the agreement to the terms and conditions 
  if ($_POST['agreement'] != 'y'){
    $error_msg .= 'invalid_agreement';
  }  
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
      $error_msg .= 'invalidEmail';
    }else {
      //Validating email / Assigning Variables
      $email = filter_var($pre_email, FILTER_VALIDATE_EMAIL);
    }
     


      /* Backend check for Passwrod Validity */
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password_confirm = filter_input(INPUT_POST, 'passwordconfirm', FILTER_SANITIZE_STRING);
    if ($password != $password_confirm){
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

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists in the database 
            //returning an error variable 
            $error_msg .= 'usedEmail';
        }
    }else {
      $error_msg .= 'GeneralError';
  } 
      


    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (first_name, second_name, username, password, salt, get_messages_from, hearts, my_link, email, show_up_search) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssssiissi', $first_name, $second_name, $username, $password, $random_salt, $get_msg = 1, $hearts_num = 1, $var = NULL, $email, $show_up_true = 1);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../../index.php?registererror=true');
                exit();
            }
        }
        header('Location: ../../login.php?signup=success');
        
    }else {
        if($error_msg == "usedEmail"){
          header('Location: ../../register.php?used_email=true');
        }else if ($error_msg == "invalidPassword"){
          header('Location: ../../register.php?invalid_password=true');
        }
        else if ($error_msg == "invalidEmail"){
          header('location: ../../register.php?invalid_email=true');
        }else if ($error_msg == "GeneralError"){
          header('Location: ../../register.php?registererror=true');
        }else if ($error_msg == "invalid_agreement"){
          
          header('location: ../../register.php?invalidAgree=true');
        }else{
          header('location: ../../register.php?unknownError=true');
        }

    }
}else {
  echo "not all variables are set ! ";
}
