<?php

/* The Logout Script */

include_once 'functions.php';
user_sec_session_start();


/* Getting the User temp logout Username from the array :) */
$user_name = $_COOKIE['Xuser'];

// Unset all session values
$_SESSION = array();

// get session parameters
$params = session_get_cookie_params();

// Delete the actual cookies.
setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// EVEN CLOSED BROWSER COOKIE DESTROY
  setcookie("Xuser", "", time() - (86400 * 30), "/"); // 86400 = 1 day
  setcookie("Xemail", "", time() - (86400 * 30), "/"); // 86400 = 1 day
  setcookie("Xtoken", "", time() - (86400 * 30), "/"); // 86400 = 1 day

// Destroy session
session_destroy();
if (isset($_GET['deletedaccount']) and  $_GET['deletedaccount']== true ){
  header("Location: ../../login.php?deletedaccount=true");
  exit();
}
else if (isset($_GET['relogin']) and $_GET['relogin']== true){
  header("Location: ../../login.php?relogin=true");
  exit();
}

else {
  header("Location: ../../index.php?userloggedout=true&lgoutusername=$user_name");
  exit();
}

