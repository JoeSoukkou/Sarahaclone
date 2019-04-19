
<?php 
// NATIVE PHP CODE AS REQUESTED 
// Coded by Yusuf Soukkou 

include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

@admin_sec_session_start();
if (isset($_COOKIE['Xuser'])){
    header("Location: ../../index.php");
}
if (admin_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
    header("Location: dashboard.php");

} else {
    $user_logged = 'out';
    header("Location: ../index.php?pleaselogin=true");
}
/* php code goes under this section of the program */



?>