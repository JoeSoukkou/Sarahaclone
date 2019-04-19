
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

} else {
    $user_logged = 'out';
    header("Location: ../index.php?pleaselogin=true");
}
/* php code goes under this section of the program */



?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $_COOKIE['Auser'];?> | Control Panel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#Insertsomelink" class="simple-text">
                    <?php echo $_COOKIE['Astname']." ".$_COOKIE['Andname'];?>
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>لوحة التحكم</p>
                    </a>
                </li>
                <li>
                    <a href="myaccount.php">
                        <i class="pe-7s-id"></i>
                        <p>حسابي</p>
                    </a>
                </li>
                <li>
                    <a href="admins.php">
                        <i class="pe-7s-user"></i>
                        <p>المشرفين</p>
                    </a>
                </li>
                <li class="active">
                    <a href="users.php">
                        <i class="pe-7s-note2"></i>
                        <p>قائمة المستخدمين</p>
                    </a>
                </li>
                <li>
                    <a href="messages.php">
                        <i class="pe-7s-news-paper"></i>
                        <p> ( الرسائل (<span class="notification hidden-sm hidden-xs">
                        <?php 
                        if ($stmt = $mysqli->prepare("SELECT *
				             FROM `dash_messages` WHERE is_read = 0
                                                ")) ;
                        $stmt->execute();    // Execute the prepared query.
                        $stmt->store_result();


                        $num_of_users = $stmt->num_rows;
                        echo $num_of_users;
                        ?>
                        </span></p>
                    </a>
                </li>
                
              
				
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">لوحة التحكم</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">لوحة التحكم</p>
                            </a>
                        </li>
                    
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="myaccount.php">
                               <p>حسابي</p>
                            </a>
                        </li>
                   
                        <li>
                            <a href="../includes/logout.php">
                                <p>الخروج</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">قائمة المستخدمين المسجلين بالموقع</h4>
                                <p class="category">يمكنك حذف أو حظر الأعضاء</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr><th>الرقم</th>
                                    	<th>الإسم كاملا</th>
                                    	<th>البريد الإلكتروني</th>
                                    	<th>الحظر</th>
                                    	<th>الحذف</th>
                                    </tr></thead>
                                    <tbody>
                                    <?php 
                                        $stmt = "SELECT id, first_name, second_name, email, blocked
                                        FROM members
                                                    ";
                                        $response = @mysqli_query($mysqli, $stmt);

                                        while ($row = mysqli_fetch_array($response)){
                                            if ($row['blocked'] == 1 ){
                                                echo '
                                            <tr>
                                                <td>'.$row['id'].'</td>
                                                <td>'.$row['first_name'].' '.$row['second_name'].'</td>
                                                <td>'.$row['email'].'</td>
                                                <form method="post" action="../includes/deleteblockuser.php">
                                                
                                                <td><button name="unblock" type="submit" value="'.$row['email'].'" class="btn btn-sm btn-success">إلفاء الحظر</button></td>
                                                
                                                <td><button name="delete" type="submit" value="'.$row['email'].'" class="btn btn-sm btn-danger">حذف</button></td>
                                                </form>
                                            </tr>';

                                            }else {
                                                echo '
                                                <tr>
                                                    <td>'.$row['id'].'</td>
                                                    <td>'.$row['first_name'].' '.$row['second_name'].'</td>
                                                    <td>'.$row['email'].'</td>
                                                    <form method="post" action="../includes/deleteblockuser.php">
                                                    
                                                    
                                                    <td><button name="block" type="submit" value="'.$row['email'].'" class="btn btn-sm btn-warning">حظر</button></td>
    
                                                    
                                                    <td><button name="delete" type="submit" value="'.$row['email'].'" class="btn btn-sm btn-danger">حذف</button></td>
                                                    </form>
                                                </tr>';
                                            }
                                          
                                        
                                        }
                                        
                                    ?>
                                        
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="../../index.php">
                                الموقع
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                الخصوصية
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                القوانين
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> برمجة وتطوير <a href="#emailAdressorsomething">يوسف صوكو</a>  
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){


    	});
	</script>

</html>
