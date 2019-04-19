<?php 
include_once 'db_connect.php';
include_once 'psl-config.php';
$error_msg = "";

if (isset($_POST['Name']) and isset($_POST['Email']) and isset($_POST['Message']) and isset($_POST['Send']) ) {
    //Verify the agreement to the terms and conditions 
    if ($_POST['Phone'] == ''){
      $phone = NULL;
    }  else {
        $phone = htmlentities($_POST['Phone']);
    }
	
    // Sanitize and validate the data passed in
    $name = htmlentities($_POST['Name']);
    // Sanitize and validate the data passed in
    $email = htmlentities($_POST['Email']);
       // Sanitize and validate the data passed in
    $message = htmlentities($_POST['Message']);

  
      
      // Username validity and password validity have been checked client side as well , so these are just extra steps to secure the script.
      // This should should be adequate as nobody gains any advantage from
      // breaking these rules.
      // Should not worry about client side Password and Email verification :)
  
      $statement = "SELECT blocked FROM members WHERE email = ?";
      $stmt = $mysqli->prepare($statement);
  
      if ($stmt) {
          $stmt->bind_param('s', $email);
          $stmt->execute();
          $stmt->store_result();
            // get variables from result.
          $stmt->bind_result($is_user_blocked);
          $stmt->fetch();

          if ($stmt->num_rows == 1) {
              if ($is_user_blocked == 1){
                echo "You are blocked from sending messages ";
                header('Location: ../../contact.php?UserBlocked=true');

              }else {
                  //Can post the data to the database 
                    if ($insert_stmt = $mysqli->prepare("INSERT INTO dash_messages (sender_name, sender_email, sender_phone, sender_content) VALUES (?, ?, ?, ?)")) {
                    $insert_stmt->bind_param('ssss', $name, $email, $phone, $message);
                    // Execute the prepared query.
                        if (! $insert_stmt->execute()) {
                            header('Location: ../../contact.php?MessageSent=false');
                            exit();
                        }
                    }
                    header('Location: ../../contact.php?MessageSent=true');
              }
          }else{
              //User email doesn't exist in the database , Can't possibly check for blocked status
            //Can post the data to the database 
                    // Insert the new user into the database
                    if ($insert_stmt = $mysqli->prepare("INSERT INTO dash_messages (sender_name, sender_email, sender_phone, sender_content) VALUES (?, ?, ?, ?)")) {
                        $insert_stmt->bind_param('ssss', $name, $email, $phone, $message);
                        // Execute the prepared query.
                            if (! $insert_stmt->execute()) {
                                header('Location: ../../contact.php?MessageSent=false');
                                exit();
                            }
                        }
                        header('Location: ../../contact.php?MessageSent=true');
          }
      }
      else {
            // Statement exec error
            header("location: ../Cantexecutestmt.php");
        } 
        



    }   


?>