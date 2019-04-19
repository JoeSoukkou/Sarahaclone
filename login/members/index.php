<?php
//Checking If the User is logged in or not , then orienting them to the proper page !
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
@user_sec_session_start();


if (user_login_check($mysqli) == true || user_cookie_login_check($mysqli) == true) {
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
    <title> الصفحة الرئيسية حسابي - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="../../css/floating-labels.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="../../css/all.css" rel="stylesheet">
    <link href="../../css/contact_form.css" rel="stylesheet">    
    <style>/* CSS OF THE LOADING SPINNER */
    body {
    padding-top: 5rem;
    }
    
    .se-pre-con{
      background: url("../../resources/spinner.gif") center no-repeat #fff;
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
            <li class="nav-item">
                <a class="nav-link" href="messages.php"> الرسائل <i class="far fa-comment"></i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="options.php">الخيارات  <i class="fas fa-wrench"></i></a>
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
    <!-- Navbar ends here -->


<main role="main" class="container">
        <!-- Page Content -->
    <div class="starter-template">
            <h4>الحساب الشخصي  </h4>
            <p class="lead">يمكنك تفقد الرسائل التي وصلتك<br> في الأسفل  <br> شارك رابطك : <br>
            <?php 
            $stmt = $mysqli->prepare("SELECT id
            FROM members
                                        WHERE email = ? LIMIT 1");
            $email= $_COOKIE['Xemail'];
            $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($user_id);
            $stmt->fetch();
            
            
            
            ?>
            <?php echo '<a href="../../send.php?id='.$user_id.'"> http://yoursite.com/send.php?id='.$user_id.'</a>'; 
            ?>
            </p>
            <div class="row">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">الرسائل</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">المفضلة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">المحفوظة</a>
            </li>
            </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                        <th> الرسائل</th>
                                        <th> تفضيل</th>
                                        <th> حفظ</th>
                                        <th> مسح</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $token = $_COOKIE['Xtoken'];
                                        
                                        $stm = $mysqli->prepare("SELECT email 
                                                FROM members
                                                                WHERE password = ? LIMIT 1");
                                        $stm->bind_param('s', $token);  // Bind "$email" to parameter.
                                        $stm->execute();    // Execute the prepared query.
                                        $stm->store_result();

                                        // get variables from result.
                                        $stm->bind_result($forced_email);
                                        $stm->fetch();

                                        $st = $mysqli->prepare("SELECT id 
                                                FROM members
                                                                WHERE email = ? ");
                                        $st->bind_param('s', $forced_email);  // Bind "$email" to parameter.
                                        $st->execute();    // Execute the prepared query.
                                        $st->store_result();

                                        // get variables from result.
                                        $st->bind_result($forced_id);
                                        $st->fetch();


                                    
                                        $stmt = "SELECT message
                                        FROM messages WHERE user_link_id = $forced_id 
                                                    ";
                                         // Bind "$email" to parameter.
            
                                        $response = @mysqli_query($mysqli,$stmt);

                                        while ($row = mysqli_fetch_array($response)){
                                            
                                                echo '
                                            <tr>
                                                <td>'.$row['message'].'</td>
                                                
                                                <form method="post" action="../includes/deleteusermessage.php">
                                                <td><button name="fav" type="submit" value="" class="btn btn-sm btn-warning"> تفضيل</button></td>
                                                <td><button name="sav" type="submit" value="" class="btn btn-sm btn-info">حفظ </button></td>
                                                             
                                                <td><button name="dlt" type="submit" value="" class="btn btn-sm btn-danger">حذف الرسالة</button></td>
                                                </form>
                                            </tr>';

                      
                                          
                                        
                                        }
                                        
                                    ?>
                                        
                                        
                                    </tbody>
                                </table>

                            </div>    
            
            
            
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">لا رسائل مفضلة</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">لا رسائل محفوظة</div>
            </div>
       
    
    </div>
        

</main><!-- /.container -->




    <!-- Responsive Design Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="../../js/all.js"></script>
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