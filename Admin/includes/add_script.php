<?php

/*
 The User Registration File Functions 
 */

include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';

if (admin_cookie_login_check($mysqli) == true) {

  if (isset($_POST['sendcodes']) and isset($_POST['add_script'])) {
    
    // Store the data passed in
      $d_script = $_POST['add_script'];
       

        
  
          // Insert the new user into the database
          if ($insert_stmt = $mysqli->prepare("INSERT INTO ads (ads_script) VALUES (?)")) {
              $insert_stmt->bind_param('s', $d_script);
              // Execute the prepared query.
              if (! $insert_stmt->execute()) {
                  header('Location: ../dashboard.php?adsfailed=true');
                  exit();
              }
          }
          header('Location: ../Panel/dashboard.php?adsadded=true');
          

  
}
}else{
    $user_logged = 'out';
    header("Location: ../index.php?pleaselogin=true");
  }