<?php
/* END OF ADMIN AND USER LOGIN CHECK */
include_once 'db_connect.php';
include_once 'functions.php';

@user_sec_session_start();

if (user_login_check($mysqli) == true) {
    $user_logged = 'in';

} else {
    $user_logged = 'out';
    header("Location: ../../login.php?pleaselogin=true");
}
/* php code goes under this section of the program */
?>
