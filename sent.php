<?php 
// NATIVE PHP CODE AS REQUESTED 
// Coded by Yusuf Soukkou 

include_once 'login/includes/db_connect.php';
include_once 'login/includes/functions.php';

@user_sec_session_start();

if(isset($_GET['id']) and $_GET['id'] != "" and isset($_GET['msgsent']) and $_GET['msgsent'] == true){
    $sendto_id = $_GET['id'];


}
else {
    header('location: index.php');
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
    <title> ام الإرسال - الموقع </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="css/floating-labels.css" rel="stylesheet">
    <!-- CDN ICONS font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="css/all.css" rel="stylesheet">
    <link href="css/contact_form.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>/* CSS OF THE LOADING SPINNER */
    .se-pre-con{
      background: url("resources/spinner.gif") center no-repeat #fff;
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
                <a class="nav-link" href="about.php">عن الموقع <i class="fab fa-connectdevelop"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> إتصل بنا  <i class="far fa-envelope"></i></a>
            </li>
            </ul>
        </div>
    </nav>

    <!-- Navbar ends here -->
<div role="main" class="container">

    <div class="starter-template">
        <h3>لقد تم إرسال الرسالة بنجاح لصاحبها </h3>

        <?php echo '
        
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
        تم إرسال الرسالة بنجاح<i class="fas fa-exclamation-triangle"></i>
            </div>
            
    
        </div>
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
            <a href="send.php?id='.$sendto_id.'">أعد إرسال رسالة أخرى من هنا</a>
            </div>
            
    
        </div>
        
        
        
        
        
        ';?>
    </div>
 <!-- The Contact Form -->

    <!-- End of the Contact Form -->

</div><!-- /.container -->
   




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