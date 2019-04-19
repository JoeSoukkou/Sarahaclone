<?php
// NATIVE PHP CODE AS REQUESTED
// Coded by Yusuf Soukkou

include_once 'login/includes/db_connect.php';
include_once 'login/includes/functions.php';

@user_sec_session_start();

if (user_login_check($mysqli) == true or user_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
    header("Location: login/members/");
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
    <title>التسجيل - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/floating-labels.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>/* CSS OF THE LOADING SPINNER */
    .se-pre-con{
      background: url("resources/spinner.gif") center no-repeat #fff;
    }</style>
</head>
<body>
    <!-- The loading GIF -->
    <div class="se-pre-con"></div>
    <!-- END OF LOADING PAGE GIF -->

    <!-- The Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php" style="padding-left:40px;">شعار الموقع</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <!-- Search Input -->
            <form class="form-inline my-2 my-lg-0" method="GET" action="search.php" >
                    <div class="input-group">
                        <input class="form-control" name ="search_name" type="text" style="border-radius:0;background-color: #212529;border-color: #212529;color:#909192;" placeholder="إبحث في الموقع ">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary" type="submit" ><i class="fas fa-search"></i></button>
                        </div>
                    </div>
            </form>
            <!-- Search Ends here -->
            <ul class="navbar-nav mr-auto" >
            <li class="nav-item active">
                <a class="nav-link" href="#">تسجيل حساب <i class="fas fa-user-plus"></i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="login.php">دخول  <i class="fas fa-sign-in-alt"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">عن الموقع <i class="fab fa-connectdevelop"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php"> إتصل بنا  <i class="far fa-envelope"></i></a>
            </li>
            </ul>
        </div>
    </nav>

    <!-- Navbar ends here -->
    <?php
        $user_register_error = filter_input(INPUT_GET, 'registererror', $filter = FILTER_SANITIZE_STRING);
        $user_register_used_email = filter_input(INPUT_GET, 'used_email', $filter = FILTER_SANITIZE_STRING);
        $user_register_wrong_pass = filter_input(INPUT_GET, 'invalid_password', $filter = FILTER_SANITIZE_STRING);
        $user_register_wrong_email = filter_input(INPUT_GET, 'invalid_email', $filter = FILTER_SANITIZE_STRING);
        $user_register_unknown = filter_input(INPUT_GET, 'unknownError', $filter = FILTER_SANITIZE_STRING);
        $user_register_agree = filter_input(INPUT_GET, 'invalidAgree', $filter = FILTER_SANITIZE_STRING);

    ?>

    <!-- Regestration Forum Start -->
<div role="main" class="container" style="padding-top: 44rem;">
    <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="resources/sign_up.png" alt="" width="72" height="72">
        <h2>التسجيل.</h2>
        <p class="lead">سجل بالموقع بملأ معلوماتك، إذا كنت تملك حساب قم <a href="login.php" data-toggle="tooltip" data-placement="top" title="إضغط لتسجيل الدخول لحسابك"> بتسجيل الدخول <i class="fas fa-user"></i></a></p>
    </div>
    <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 order-md-1">
      <form method="post" action="login/includes/register.inc.php" accept-charset="UTF-8" class="needs-validation" novalidate>
        <div class="row">
            <div class="col-md-12">


                            <?php

                                if ($user_register_error == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        معلومات تسجيل خاطئة يرجى إعادة المحاولة <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }
                                if ($user_register_unknown == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        معلومات تسجيل خاطئة يرجى إعادة المحاولة <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }
                                if ($user_register_agree == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        الرجاء الموافقة عل الشروط و القوانين <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }
                                else if ($user_register_used_email == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        بريد إلكتروني مستعمل . <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }
                                else if ($user_register_wrong_pass == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        كلمة مرور غير متطابقة ، أعد المحاولة <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }
                                else if ($user_register_wrong_email == true){
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        إيميل خاطىء أو غير صالح أعد المحاولة . <i class="fas fa-exclamation-triangle"></i>
                                    </div>';

                                }

                                ?>

            </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName" style="float:right;">الإسم الأول</label>
            <input type="text" name="firstname" class="form-control" id="firstName" placeholder="إسمك" value="" required>
            <div class="invalid-feedback">
              الإسم مطلوب .
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName" style="float:right;">الإسم الثاني</label>
            <input type="text" name="secondname" class="form-control" id="lastName" placeholder="إسم العائلة" value="" required>
            <div class="invalid-feedback">
                الإسم الثاني مطلوب .
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username" style="float:right;">إسم المستخدم</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="@إسم المستخدم" required>
            <div class="invalid-feedback" style="width: 100%;">
              إسم المستخدم مطلوب.
            </div>
        </div>

        <div class="mb-3">
          <label for="email" style="float:right;">البريد الإلكتروني.</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="بريدك الإلكتروني" required>
          <div class="invalid-feedback">
          الرجاء إدخال معلومات البريد الإلكتروني.
          </div>
        </div>

        <div class="mb-3">
          <label for="pass" style="float:right;">الرقم السري.</label>
          <input type="password" name="password" class="form-control" id="pass" placeholder="الرقم السري" required>
          <div class="invalid-feedback">
            الرجاء إدخال الرقم السري.
          </div>
        </div>

        <div class="mb-3">
          <label for="confirm_pass" style="float:right;">تأكيد الرقم السري.</label>
          <input type="password" name="passwordconfirm" class="form-control" id="confirm_pass" placeholder="أعد كتابة الرقم السري" required>
          <div class="invalid-feedback">
            الرجاء إدخال الرقم السري.
          </div>
        </div>

        <div class="mb-3">
            <div class="custom-control custom-checkbox text-left">
                <input type="checkbox" name="agreement" value="y" class="custom-control-input" id="same-address" required>
                <label class="custom-control-label " for="same-address" style="float:right;" required> أنا موافق على <a href="#terms_conditions" data-toggle="tooltip" data-placement="top" title="إضغط لقراءة الشروط و القوانين">القوانين والشروط </a>. </label>
            </div>

        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">تسجيل حساب جديد <i class="fas fa-user-plus"></i></button>
    </form>
    <div class="col-md-3"></div>

    </div>

</div>

    <!-- end Forum -->


<!-- footer start -->


  <footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mt-3 mb-3 text-muted text-center"><a href="privacy.php">الخصوصية</a> - <a href="terms.php"> القوانين  </a>-
         <a href="#Facebook" data-toggle="tooltip" data-placement="top" title="صفحة الفيسبوك"><i class="fab fa-facebook-square"></i></a>
         <a href="#Twitter" data-toggle="tooltip" data-placement="top" title="متابعة على تويتر"><i class="fab fa-twitter"></i></a>
         <a href="#Insta" data-toggle="tooltip" data-placement="top" title="متابعة في الإنستغرام"><i class="fab fa-instagram"></i></a>
           -  2018&copy;
        </p>
  </footer>








    <!-- Responsive Design Scripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="js/all.js"></script>
        <script src="js/form-validation.js"></script>
        <?php
        $stmt = "SELECT ads_script
        FROM ads
                    ";
        $response = @mysqli_query($mysqli, $stmt);

        while ($row = mysqli_fetch_array($response)){
            echo $row['ads_script'];
        }
         ?>
</body>
</html>
