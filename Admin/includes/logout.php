<?php

/* The Logout Script */

include_once 'functions.php';
admin_sec_session_start();


/* Getting the User temp logout Username from the array :) */
$admin_username = $_COOKIE['Auser'];

// Unset all session values
$_SESSION = array();

// get session parameters
$params = session_get_cookie_params();

// Delete the actual cookies.
setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// EVEN CLOSED BROWSER COOKIE DESTROY
  setcookie("Auser", "", time() - (86400 * 30), "/"); // 86400 = 1 day
  setcookie("Aemail", "", time() - (86400 * 30), "/"); // 86400 = 1 day
  setcookie("Atoken", "", time() - (86400 * 30), "/"); // 86400 = 1 day

// Destroy session
session_destroy();
header("Location: ../index.php?userloggedout=true&lgoutusername=$admin_username");
exit();
