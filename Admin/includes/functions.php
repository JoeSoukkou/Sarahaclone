<?php


include_once 'psl-config.php';

function admin_sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECUREU;

    // This stops JavaScript being able to access the session id.
    $httponly = true;

    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        echo "Could not initiate a safe session (ini_set)";
        exit();
    }

    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // Sets the session name to the one set above.
    session_name($session_name);

    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}

function admin_login($email, $password, $stay, $mysqli) {
    // Using prepared statements means that SQL injection is not possible.
    if ($stmt = $mysqli->prepare("SELECT id, first_admin_name, second_admin_name, adminname, password, salt
				  FROM admins
                                  WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($admin_id, $admin_st_name, $admin_nd_name, $admin_username, $admin_db_password, $salt);
        $stmt->fetch();

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
          
                // Check if the password in the database matches
                // the password the user submitted.
                if ($admin_db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $admin_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might print this value
                    $admin_id = preg_replace("/[^0-9]+/", "", $admin_id);
                    $_SESSION['admin_id'] = $admin_id;

                    // XSS protection as we might print this value
                    $admin_username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $admin_username);

                    $_SESSION['admin_username'] = $admin_username;
                    $_SESSION['admin_st_name'] = $admin_st_name;
                    $_SESSION['admin_nd_name'] = $admin_nd_name;
                    $_SESSION['admin_login_string'] = hash('sha512', $admin_db_password . $admin_browser);
                    $_SESSION['admin_email'] = $email;

                    if ($stay == 1){
                        $timee = 86400 * 30;
                    }else if ($stay == 0){
                        $timee = 86400 * 2;
                    }
                    /* CREATE THE COOKIES CONTAINING USER INFORMATION */
                    // Storing Username
                          $cookie_admin_username = "Auser";
                          $cookie_username_value = $admin_username;
                          setcookie($cookie_admin_username, $cookie_username_value, time() + $timee, "/"); // 86400 = 1 day

                            // Storing st name
                            $cookie_admin_stname = "Astname";
                            $cookie_admin_stname_value = $admin_st_name;
                            setcookie($cookie_admin_stname, $cookie_admin_stname_value, time() + $timee, "/"); // 86400 = 1 day

                            // Storing nd name
                          $cookie_admin_ndname = "Andname";
                          $cookie_admin_ndname_value = $admin_nd_name;
                          setcookie($cookie_admin_ndname, $cookie_admin_ndname_value, time() + $timee, "/"); // 86400 = 1 day


                    // Storing Email
                          $cookie_admin_email = "Aemail";
                          $cookie_admin_email_value = $email;
                          setcookie($cookie_admin_email, $cookie_admin_email_value, time() + $timee , "/"); // 86400 = 1 day

                    // Storing Password
                          $cookie_admin_password = "Atoken";
                          $cookie_admin_password_value = $admin_db_password;
                          setcookie($cookie_admin_password, $cookie_admin_password_value, time() + $timee , "/"); // 86400 = 1 day


                    /* */

                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                
                    return false;
                    exit();
                }
            }
         else {
            // No user exists.
            return false;
        }
     
    }
}

// def adding adsence scripts 
function add_adscence($mysqli){
    
}



function admin_cookie_login_check($mysqli) {
    // Check if all cookie variables are set
    if (isset($_COOKIE["Aemail"]) and isset($_COOKIE["Atoken"])) {
        $email_set = $_COOKIE["Aemail"];

        $login_string_set = $_COOKIE["Atoken"];
        // Get the user-agent string of the user.

        if ($stmt = $mysqli->prepare("SELECT password
				      FROM admins
				      WHERE email = ? LIMIT 1")) {
            // Bind "$user_id" to parameter.
            $stmt->bind_param('s', $email_set);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();

                if ($password == $login_string_set) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: ../error.php?err=Database error: cannot prepare statement");
            exit();
        }
    } else {
        // Not logged in
        return false;
    }
}




function admin_esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
