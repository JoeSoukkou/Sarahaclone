<?php



include_once 'db_connect.php';
include_once 'functions.php';

@user_sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['password'])) {
    // check if user wants to stay logged in 
    if (isset($_POST['remember'])){
        $keepmelogged = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_STRING);

        if ($keepmelogged == 'y'){
            $stay = 1;
        }else {
            $stay= 0 ;
        }

    }else {
        $stay = 0;
    }
    
    
    //Validating email / Assigning Variables
    $emaill = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $email = filter_var($emaill, FILTER_VALIDATE_EMAIL);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // The hashed password.
    
    if (user_login($email, $password, $stay, $mysqli) == true) {
        // Login success
        header("Location: ../members/index.php");

    } else {
        // Login failed
        header('Location: ../../login.php?loginerror=true');
        exit();
    }
} else {
    // The correct POST variables were not sent to this page.
    // Login failed
    header('Location: ../../login.php?loginerror=true');
    exit();
}
