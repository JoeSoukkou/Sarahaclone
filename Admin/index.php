<?php 
// NATIVE PHP CODE AS REQUESTED 
// Coded by Yusuf Soukkou 

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

@admin_sec_session_start();
if (isset($_COOKIE['Xuser'])){
    header("Location: ../index.php");
}
if (admin_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
    header("Location: Panel/");
} else {
    $user_logged = 'out';
    /*header("Location: ../index.php?pleaselogin=true");*/
}
/* php code goes under this section of the program */



?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="author" content="Yusuf Soukkou">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>لوحة التحكم - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="../css/floating-labels.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../css/all.css" rel="stylesheet">
    <style>/* CSS OF THE LOADING SPINNER */
    .se-pre-con{
      background: url("../resources/spinner.gif") center no-repeat #fff;
    }</style>
</head>
<body>
    <!-- The loading GIF -->
  <div class="se-pre-con"></div>
  <!-- END OF LOADING PAGE GIF -->

    

    <!-- Navbar ends here -->

        <!-- Sign in form -->
    <form class="needs-validation form-signin" dir="ltr" novalidate style="position:relative;top:2em;" method="post" action="includes/process_login.php">
        <div class="text-center mb-4">
            <img class="mb-4" src="../resources/user_login.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">لوحة التحكم</h1>
            <p>يمكنك تسجيل الدخول للوحة التحكم من هنا   </p>
        </div>
        <?php
            //Get the Error Login MSG
             $user_login_error = filter_input(INPUT_GET, 'loginerror', $filter = FILTER_SANITIZE_STRING);
             $user_please_login = filter_input(INPUT_GET, 'pleaselogin', $filter = FILTER_SANITIZE_STRING);
             $relog = filter_input(INPUT_GET, 'relogin', $filter = FILTER_SANITIZE_STRING);

            ?>
        <?php 
         
             if ($user_login_error == true){
                echo '<div class="form-label-group">
                <div class="alert alert-danger" role="alert">
                    معلومات دخول خاطئة يرجى إعادة المحاولة <i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>';
             }
             if ($user_please_login == true){
                echo '<div class="form-label-group">
                <div class="alert alert-danger" role="alert">
                   الرجاء تسجيل الدخول للمتابعة<i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>';
             }
             if ($relog == true){
                echo '<div class="form-label-group">
                <div class="alert alert-danger" role="alert">
                   الرجاء معاودة تسجيل الدخول<i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>';
             }
        ?>
        <div class="form-label-group">
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputEmail">البريد الإلكتروني</label>
            <div class="invalid-feedback">
            الرجاء إدخال البريد الإلكتروني.
            </div>
        </div>

        <div class="form-label-group" >
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword" >كلمة المرور</label>
            <div class="invalid-feedback">
            الرجاء إدخال كلمة المرور.
            </div>
        </div>

        <div class="checkbox mb-3" >
            <div class="custom-control custom-checkbox text-right">
                <input type="checkbox" name="remember" value="y" class="custom-control-input" id="same-address" value="prolong">
                <label class="custom-control-label" for="same-address">تذكرني المرة القادمة </label>
            </div>
            
        </div>
        <button class="btn btn-lg btn-outline-primary btn-block" type="submit"> تسجيل الدخول
        <i class="fas fa-user"></i>
        </button>
        <div class="form-label-group text-center" style="padding-top:8px;">
            <a href="reset_pass.php">
                هل نسيت كلمة المرور ؟ 
            </a>
        </div>

        <p class="mt-3 mb-3 text-muted text-center"><a href="../privacy.php">الخصوصية</a> - <a href="../terms.php"> القوانين  </a>-   
         <a href="#Facebook" data-toggle="tooltip" data-placement="top" title="صفحة الفيسبوك"><i class="fab fa-facebook-square"></i></a>
         <a href="#Twitter" data-toggle="tooltip" data-placement="top" title="متابعة على تويتر"><i class="fab fa-twitter"></i></a> 
         <a href="#Insta" data-toggle="tooltip" data-placement="top" title="متابعة في الإنستغرام"><i class="fab fa-instagram"></i></a>
           -  2018&copy;
        </p>
        </form>
        <!-- Sign in form ends here -->

     


    <!-- Responsive Design Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="../js/all.js"></script>
        <script src="../js/form-validation.js"></script>


</body>
</html>