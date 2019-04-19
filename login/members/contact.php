<?php 
// NATIVE PHP CODE AS REQUESTED 
// Coded by Yusuf Soukkou 

include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

@user_sec_session_start();

if (user_login_check($mysqli) == true or user_cookie_login_check($mysqli) == true) {
    $user_logged = 'in';
    
} else {
    $user_logged = 'out';
    header("Location: ../../contact.php");
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
    <title>الإتصال بنا - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="../../css/floating-labels.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/contact_form.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>/* CSS OF THE LOADING SPINNER */
    
    .se-pre-con{
      background: url("../../resources/spinner.gif") center no-repeat #fff;
    }
    .container ul{
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    margin-top: 50px;
    margin-bottom: 50px;

    padding-top: 80px;
    padding-bottom: 80px;

    display: flex;
    
    }
    .container ul li{
    list-style: none;
    margin: 0 40px;
    
    }
    .container ul li .fa{
    font-size: 30px;
    color: #262626;
    line-height: 80px;
    transition: .5s;
    
    }
    .container ul li a{
    position: relative;
    display: block;
    width: 80px;
    height: 80px;
    background-color: #fff;
    text-align: center;
    transform: perspective(100px) rotate(-30deg) skew(25deg) translate(0,0);
    transition: .5s;
    box-shadow: -20px 20px 10px rgb(0, 0, 0, 0.5);
    }
    .container ul li a::before{
    content: "";
    position: absolute;
    top: 10px;
    left: -20px;
    height: 100%;
    width: 20px;
    background: #b1b1b1;
    transition: .5s;
    transform: rotate(0deg) skewY(-45deg);
    }
    .container ul li a::after{
    content: "";
    position: absolute;
    top: 80px;
    left: -11px;
    height: 20px;
    width: 100%;
    background: #b1b1b1;
    transition: .5s;
    transform: rotate(0deg) skewX(-45deg);
    }
    .container ul li a:hover{
    transform: perspective(1000px) rotate(-30deg) skew(25deg) translate(20px, -20px);
    box-shadow: -50px 50px 50px rgb(0, 0, 0, 0.5);
    }
    .container ul li:hover .fa{
    color: #fff;
    }
    .container ul li a:hover{
    transform: perspective(1000px) rotate(-30deg) skew(25deg) translate(20px, -20px);
    box-shadow: -50px 50px 50px rgb(0, 0, 0, 0.5);
    }
    .container ul li:hover:nth-child(1) a{
    background: #3b5999;
    }
    
    .container ul li:hover:nth-child(1) a:before{
    background: #2e4a86;
    }
    .container ul li:hover:nth-child(1) a:after{
    background: #4a69ad;
    }
    .container ul li:hover:nth-child(2) a{
    background: #55acee;
    }
    .container ul li:hover:nth-child(2) a:before{
    background: #4184b7;
    }
    .container ul li:hover:nth-child(2) a:after{
    background: #4d9fde;
    }
    .container ul li:hover:nth-child(3) a{
    background: #dd4b39;
    }
    
    .container ul li:hover:nth-child(3) a:before{
    background: #c13929;
    }
    .container ul li:hover:nth-child(3) a:after{
    background: #e83322;
    }
    
    .container ul li:hover:nth-child(4) a{
    background: #0077B5;
    }
    
    .container ul li:hover:nth-child(4) a:before{
    background: #036aa0;
    }
    .container ul li:hover:nth-child(4) a:after{
    background: #0d82bf;
    }
    
    .container ul li:hover:nth-child(5) a{
    background: linear-gradient(#400080, transparent), linear-gradient(200deg, #d047d1, #ff0000, #ffff00);
    }
    
    .container ul li:hover:nth-child(5) a:before{
    background: linear-gradient(#400080, transparent), linear-gradient(200deg, #d047d1, #ff0000, #ffff00);
    }
    .container ul li:hover:nth-child(5) a:after{
    background: linear-gradient(#400080, transparent), linear-gradient(200deg, #d047d1, #ff0000, #ffff00);
    }
</style>
</head>
<body>
  <!-- The loading GIF -->
  <div class="se-pre-con"></div>
  <!-- END OF LOADING PAGE GIF -->
    <!-- The Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" >
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
            <li class="nav-item ">
                <a class="nav-link" href="options.php">الخيارات  <i class="fas fa-wrench"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">عن الموقع <i class="fab fa-connectdevelop"></i></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#"> إتصل بنا  <i class="far fa-envelope"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php"> الخروج  <i class="fas fa-unlock"></i></a>
            </li>
            </ul>
        </div>
    </nav>

    <!-- Navbar ends here -->
<div role="main" class="container">

    <div class="starter-template">
        <h3>صفحة التواصل مع فريق العمل .</h3>
        <p class="lead"> يمكنك التواصل معنا عبر مختلف المنصات .</p>
        <div class="row d-none d-md-block">
            <div class="col-xs-3"><ul>
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul></div>
            
        </div>
    </div>
 <!-- The Contact Form -->
 <div class="container contact-form">
                    <form accept-charset="UTF-8" method="post" action="../includes/add_message.php" class="needs-validation" novalidate>
                        <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        $message_sent = filter_input(INPUT_GET, 'MessageSent', $filter=FILTER_SANITIZE_STRING);
                                        $user_blocked = filter_input(INPUT_GET, 'UserBlocked', $filter=FILTER_SANITIZE_STRING);
 
                                        if ($message_sent == true){
                                            echo '<div class="form-label-group">
                                            <div class="alert alert-success" role="alert">
                                            تم إرسال الرسالة بنجاح <i class="fas fa-exclamation-triangle"></i>
                                            </div>
                                            </div>';
                                    } 
                                    if ($user_blocked == true)
                                    {
                                     echo '<div class="form-label-group">
                                     <div class="alert alert-danger" role="alert">
                                     لا يمكنك إرسال الرسائل ، حساب محظور <i class="fas fa-exclamation-triangle"></i>
                                     </div>
                                     </div>';

                                    }  
                                    ?>
                                    
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Name" class="form-control" placeholder="إسمك كاملا" value="<?php echo $_COOKIE['Xstname'].' '.$_COOKIE['Xndname']?>" required/>
                                        <div class="invalid-feedback">
                                        الرجاء إدخال  إسمك.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="Email" class="form-control" value="<?php echo $_COOKIE['Xemail'] ?>"/>
                                       
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Phone" class="form-control" placeholder="الهاتف أو حساب فيسبوك (إختياري)" value="" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="Send" class="btn btn-outline-primary btn-lg btn-block" required/>إرسال 
                                        <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea name="Message" class="form-control" placeholder="مضمون رسالتك ..." style="width: 100%; height: 210px;" required></textarea>
                                        <div class="invalid-feedback">
                                        الرجاء إدخال  رسالتك.
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                    </form>

        
    </div>
    <!-- End of the Contact Form -->

</div><!-- /.container -->
   




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