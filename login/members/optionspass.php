<?php
//Checking If the User is logged in or not , then orienting them to the proper page !
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
@user_sec_session_start();


if (user_login_check($mysqli) == true or user_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
} else {
    $user_logged = 'out';
    header("Location: ../../login.php?pleaselogin=true");
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="">
    <meta name="author" content="Yusuf Soukkou">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>  الخيارات - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="../../css/floating-labels.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../css/all.css" rel="stylesheet">
    <style>/* CSS OF THE LOADING SPINNER */
    /* Sticky footer styles
-------------------------------------------------- */

body {
  /* Margin bottom by footer height */
  padding-top: 20rem;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  line-height: 60px; /* Vertically center the text there */
  background-color: #f5f5f5;
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

body > .container {
  padding-top: 0rem;
}

.footer > .container {
  padding-right: 15px;
  padding-left: 15px;
}

  .se-pre-con{
      background: url("../../resources/spinner.gif") center no-repeat #fff;
    }</style>
</head>
<body>
    <!-- The loading GIF -->
    <div class="se-pre-con"></div>
    <!-- END OF LOADING PAGE GIF -->

    

    <!-- Navbar ends here -->
  <header>
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
            <li class="nav-item">
                <a class="nav-link" href="messages.php"> الرسائل <i class="far fa-comment"></i></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">الخيارات  <i class="fas fa-wrench"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">عن الموقع <i class="fab fa-connectdevelop"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php"> إتصل بنا  <i class="far fa-envelope"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php"> الخروج  <i class="fas fa-unlock"></i></a>
            </li>
            </ul>
        </div>
    </nav>
  </header>

 <!-- Regestration Forum Start -->
<div role="main" class="container" style="padding-top: 5rem;">
    <div class="row">
      <div class="col-lg-12">
        <div class="py-5 text-center">
          <h2>تعديل الحساب <i class="fas fa-user-edit"></i></h2>
          <p class="lead">يمكنك تغيير الرقم السري لحسابك أسفله  .</a></p>
        </div>
      </div> 
    </div>
    <div class="row">
    <div class="col-md-4 order-md-1">
    <div class="list-group">
   
      <a href="options.php" class="list-group-item list-group-item-action">الملف الشخصي <i class="fas fa-user-circle"></i></a>
      <a href="#" class="list-group-item list-group-item-action active">الرقم السري <i class="fas fa-key"></i></a>
      <a href="optionsdelete.php" class="list-group-item list-group-item-action ">حذف الحساب  <i class="fas fa-user-minus"></i></a>
      <a href="optionsprivate.php" class="list-group-item list-group-item-action">الخصوصية <i class="fas fa-user-secret"></i></a>
    </div>
      

    </div>
    
    <div class="col-md-8 ">
      <form method="post" action="../includes/updatepassword.php" accept-charset="UTF-8" class="needs-validation" novalidate>
        <div class="row">
        <div class="col-md-6 mb-3">
          <?php 
           $inv_oldpass = filter_input(INPUT_GET, 'invalidoldpass', $filter = FILTER_SANITIZE_STRING);
           $inv_passcom = filter_input(INPUT_GET, 'invalidpasscomb', $filter = FILTER_SANITIZE_STRING);

            if ($inv_oldpass == true){
                echo '<div class="form-label-group">
                <div class="alert alert-warning" role="alert">
                   كلمة السر القديمة خاطئة ، أعد المحاولة<i class="fas fa-exclamation-triangle"></i>
                </div>
                </div>';
            } 
            
            if ($inv_passcom == true){
              echo '<div class="form-label-group">
              <div class="alert alert-warning" role="alert">
                 كلمتي السر غير متطابقتان  <i class="fas fa-exclamation-triangle"></i>
              </div>
              </div>';
          } 
          
      
            
            
            ?>

          </div>

        </div>
        <div class="row">  
          <div class="col-md-6 mb-3">
            <label for="old_pass" style="float:right;"> كلمة المرور القديمة</label>
              <input type="password" name="oldpassword" class="form-control" id="username" placeholder="" value="" required>
              <div class="invalid-feedback" style="width: 100%;">
                الرجاء إدخال كلمة المرور القديمة
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="firstName" style="float:right;"> كلمة المرور الجديدة</label>
            <input  type="password" name="newpassword" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              أدخل كلمة مرور جديدة
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName" style="float:right;"> تأكيد كلمة المرور</label>
            <input type="password" name="newpasswordconfirm" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              تأكيد كلمة المرور ضروري
            </div>
          </div>
        </div>
        
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit"> حفظ  <i class="fas fa-user-edit"></i></button>
    </form>
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
        <script src="../../js/all.js"></script>
        <script src="../../js/form-validation.js"></script>
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