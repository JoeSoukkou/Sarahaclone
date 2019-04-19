<?php
/* END OF ADMIN AND USER LOGIN CHECK */
include_once '../../login/db_connect.php';
include_once '../../login/functions.php';

@user_sec_session_start();

if (user_login_check($mysqli) == true) {
    $user_logged = 'in';
    header("Location: ../../index.php");

} else {
    $user_logged = 'out';
    header("Location: ../../login.php?pleaselogin=true");
}
/* php code goes under this section of the program */
?>
